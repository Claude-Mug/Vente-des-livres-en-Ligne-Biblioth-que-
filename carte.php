<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_COOKIE['idClient'])) {
    $_SESSION['idClient'] = $_COOKIE['idClient']; // Récupérer l'ID du client depuis le cookie
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idClient'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion
    exit();
}

// Récupérer les informations du client
$idClient = $_SESSION['idClient'];
$clientQuery = "SELECT Nom, Prenom FROM client WHERE IdClient = ?";
$stmt = $conn->prepare($clientQuery);
$stmt->bind_param("i", $idClient);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();

// Récupérer les livres commandés avec les prix
$commandeQuery = "SELECT c.idCommande, c.quantite, c.date_commande, l.IdLivre, l.Titre, l.Prix, l.Devise 
                  FROM commandes c 
                  JOIN livres l ON c.idLivre = l.IdLivre 
                  WHERE c.idClient = ?";
$stmt = $conn->prepare($commandeQuery);
$stmt->bind_param("i", $idClient);
$stmt->execute();
$commandes = $stmt->get_result();

// Fonction pour valider le numéro de carte avec l'algorithme de Luhn
function validerNumeroCarte($numero) {
    $numero = preg_replace('/\D/', '', $numero); // Supprimer les caractères non numériques
    if (strlen($numero) < 12) {
        return false; // Le numéro doit contenir au moins 12 chiffres
    }

    // Algorithme de Luhn
    $sum = 0;
    $numDigits = strlen($numero);
    $parity = $numDigits % 2;

    for ($i = 0; $i < $numDigits; $i++) {
        $digit = intval($numero[$i]);
        if ($i % 2 === $parity) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }

    return $sum % 10 === 0;
}

// Traitement du formulaire de paiement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['livres']) && isset($_POST['numero_carte']) && isset($_POST['date_expiration']) && isset($_POST['cvv'])) {
        $livres = $_POST['livres']; // Liste des livres sélectionnés
        $numeroCarte = $_POST['numero_carte']; // Numéro de la carte bancaire
        $dateExpiration = $_POST['date_expiration']; // Date d'expiration
        $cvv = $_POST['cvv']; // Code CVV

        // Valider le numéro de carte
        if (!validerNumeroCarte($numeroCarte)) {
            $erreur = "Le numéro de carte est invalide.";
        } else {
            // Insérer les livres payés dans la table `livres_payer` avec le statut "en_attente"
            foreach ($livres as $idLivre) {
                $insertQuery = "INSERT INTO livres_payer (idClient, idLivre, statut) VALUES (?, ?, 'en_attente')";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("ii", $idClient, $idLivre);
                $stmt->execute();
            }

            // Rediriger vers la page de confirmation
            header("Location: confirmation_paiement.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Payer par carte bancaire</title>
    <style>
        .book {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 15px;
            border-radius: 5px;
            height: 100%;
            transition: transform 0.2s;
        }
        .book:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .book img {
            width: 100%;
            height: auto;
            max-height: 150px;
            border-radius: 5px;
        }
        .commandes-container {
            margin-bottom: 20px;
        }
        .resume {
            font-size: 14px;
            color: #555;
        }
        .voir-plus {
            color: #007bff;
            cursor: pointer;
        }
        .client-name {
            color: #dc3545; /* Rouge */
            font-weight: bold;
            font-size: 1.5em;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Payer par carte bancaire</h1>

    <?php if (isset($erreur)): ?>
        <div class="alert alert-danger"><?php echo $erreur; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="commandes-container">
            <h2>Livres Commandés</h2>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Sélectionner</th>
                        <th>Titre</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Date de Commande</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalCommande = 0;
                    $devise = '';
                    while ($commande = $commandes->fetch_assoc()):
                        $prixTotal = $commande['Prix'] * $commande['quantite'];
                        $totalCommande += $prixTotal;
                        $devise = $commande['Devise'];
                    ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="livres[]" value="<?php echo $commande['IdLivre']; ?>">
                            </td>
                            <td><?php echo htmlspecialchars($commande['Titre']); ?></td>
                            <td><?php echo htmlspecialchars($commande['Prix']) . ' ' . htmlspecialchars($commande['Devise']); ?></td>
                            <td><?php echo htmlspecialchars($commande['quantite']); ?></td>
                            <td><?php echo htmlspecialchars($commande['date_commande']); ?></td>
                            <td><?php echo htmlspecialchars($prixTotal) . ' ' . htmlspecialchars($commande['Devise']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <p class="font-weight-bold">Total de la commande : <?php echo htmlspecialchars($totalCommande) . ' ' . htmlspecialchars($devise); ?></p>
        </div>

        <!-- Informations de la carte bancaire -->
        <div class="form-group">
            <label for="numero_carte">Numéro de la carte :</label>
            <input type="text" class="form-control" id="numero_carte" name="numero_carte" required minlength="12" maxlength="19" pattern="\d{12,19}" title="Le numéro de carte doit contenir entre 12 et 19 chiffres.">
        </div>
        <div class="form-group">
            <label for="date_expiration">Date d'expiration :</label>
            <input type="month" class="form-control" id="date_expiration" name="date_expiration" required>
        </div>
        <div class="form-group">
            <label for="cvv">Code CVV :</label>
            <input type="text" class="form-control" id="cvv" name="cvv" required minlength="3" maxlength="4" pattern="\d{3,4}" title="Le code CVV doit contenir 3 ou 4 chiffres.">
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-success btn-block">Payer</button>
    </form>
</div>

<script>
    function applyVoirPlusFunctionality() {
        document.querySelectorAll('.voir-plus').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var shortResume = document.getElementById(id);
                var fullResume = document.getElementById(id + '_full');

                if (fullResume.style.display === 'none' || fullResume.style.display === '') {
                    shortResume.style.display = 'none';
                    fullResume.style.display = 'inline';
                    this.textContent = 'Voir moins';
                } else {
                    shortResume.style.display = 'inline';
                    fullResume.style.display = 'none';
                    this.textContent = 'Voir plus';
                }
            });
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        applyVoirPlusFunctionality();
    });
</script>

</body>
</html>

<?php
$conn->close();
?>