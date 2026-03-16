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
$commandeQuery = "SELECT c.idCommande, c.quantite, c.date_commande, l.Titre, l.Auteur, l.Prix, l.Devise 
                  FROM commandes c 
                  JOIN livres l ON c.idLivre = l.IdLivre 
                  WHERE c.idClient = ?";
$stmt = $conn->prepare($commandeQuery);
$stmt->bind_param("i", $idClient);
$stmt->execute();
$commandes = $stmt->get_result();

// Récupérer les 30 premiers livres
$livresDisponiblesQuery = "SELECT * FROM livres LIMIT 30";
$livresDisponibles = $conn->query($livresDisponiblesQuery);

// Fonction pour générer les résumés
function displayResume($resume) {
    $maxWords = 50; // Limite à 50 mots
    $words = explode(' ', $resume);
    
    if (count($words) > $maxWords) {
        $shortResume = implode(' ', array_slice($words, 0, $maxWords)) . '...';
        $id = 'resume_' . uniqid(); // Créez un ID unique basé sur le temps
        return "
            <span id='{$id}' class='resume-short'>{$shortResume}</span>
            <span id='{$id}_full' class='resume-full' style='display:none;'>{$resume}</span>
            <a href='javascript:void(0)' class='voir-plus' data-id='{$id}'>Voir plus</a>
        ";
    }
    return $resume; // Retourne le résumé complet si inférieur à 50 mots
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Mes Commandes</title>
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
            color:rgb(58, 216, 218); /* Rouge */
            font-weight: bold;
            font-size: 1.5em;
        }
        .action-buttons {
            gap: 5px;
            display: flex;
        }
        .btn-small {
            width: 50%; /* Largeur de la moitié de l'écran */
        }
        .btn-paiement {
            width: 100%; /* Largeur des boutons de paiement */
        }
        .book-buttons {
            display: flex;
            flex-wrap: wrap; /* Permet aux boutons de passer à la ligne si nécessaire */
            gap: 5px;
            margin-top: 10px;
        }
        .book-buttons .btn {
            flex: 1; /* Les boutons prennent l'espace disponible */
            padding: 5px 50px; /* Réduire la hauteur des boutons */
            font-size: 10px; /* Taille de police réduite */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Bienvenue, <span class="client-name"><?php echo htmlspecialchars($client['Prenom'] . ' ' . $client['Nom']); ?></span></h1>

    <div class="commandes-container">
        <h2>Livres Commandés</h2>
        <a class="btn btn-info" href="Index.php">Accueil</a>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Date de Commande</th>
                    <th>Total</th>
                    <th>Actions</th>
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
                        <td><?php echo htmlspecialchars($commande['Titre']); ?></td>
                        <td><?php echo htmlspecialchars($commande['Auteur']); ?></td>
                        <td><?php echo htmlspecialchars($commande['Prix']) . ' ' . htmlspecialchars($commande['Devise']); ?></td>
                        <td><?php echo htmlspecialchars($commande['quantite']); ?></td>
                        <td><?php echo htmlspecialchars($commande['date_commande']); ?></td>
                        <td><?php echo htmlspecialchars($prixTotal) . ' ' . htmlspecialchars($commande['Devise']); ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="modifier_commande.php?id=<?php echo htmlspecialchars($commande['idCommande']); ?>" class="btn btn-warning btn-sm btn-small">Modifier</a>
                                <a href="supprimer_commande.php?id=<?php echo htmlspecialchars($commande['idCommande']); ?>" class="btn btn-danger btn-sm btn-small" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">Supprimer</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p class="font-weight-bold">Total de la commande : <?php echo htmlspecialchars($totalCommande) . ' ' . htmlspecialchars($devise); ?></p>
    </div>

    <!-- Boutons de paiement et "Continuer les achats" -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="index.php" class="btn btn-secondary btn-block btn-small">Continuer les achats</a>
            <a href="confirmation_paiement.php" class="btn btn-outline-danger btn-block btn-small">Mes commande en attente et payer</a>
            <a href="mes_emprunts.php" class="btn btn-outline-success btn-block btn-small">Statut de mes livres Emprunter</a>
        </div>
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-md-4">
                    <a href="carte.php" class="btn btn-outline-primary btn-block btn-paiement">
                        <i class="bi bi-credit-card"></i> Payer par carte bancaire
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="paypal.php" class="btn btn-outline-info btn-block btn-paiement">
                        <i class="bi bi-paypal"></i> Payer avec PayPal
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="payerMobile.php" class="btn btn-outline-success btn-block btn-paiement">
                        <i class="bi bi-phone"></i> Payer par mobile (FBU, $, €)
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Livres disponibles -->
    <h2>Livres Disponibles</h2>
    <div class="row">
        <?php 
        $livresDisponibles->data_seek(0);
        while ($livre = $livresDisponibles->fetch_assoc()):
        ?>
            <div class="col-md-4">
                <div class="book">
                    <h5 class="card-title"><?php echo htmlspecialchars($livre['Titre']); ?></h5>
                    <p>Auteur: <?php echo htmlspecialchars($livre['Auteur']); ?></p>
                    <p>Prix: <?php echo htmlspecialchars($livre['Prix']) . ' ' . htmlspecialchars($livre['Devise']); ?></p>
                    <div class="resume">
                        <?php echo displayResume(htmlspecialchars($livre['Resume'])); ?>
                    </div>
                    <img src="uploads/covers/<?php echo htmlspecialchars($livre['Couverture']); ?>" alt="Couverture du livre">
                    <br>
                    <div class="book-buttons">
                    <a href="emprunter_livre.php?id=<?php echo htmlspecialchars($livre['IdLivre']); ?>" class="btn btn-outline-success">Emprunter le livre</a>
                        <a href="#" class="btn btn-outline-primary">Voir le PDF</a> <!-- Lien à coder plus tard -->
                        <a href="Ajoutpanier.php?id=<?php echo htmlspecialchars($livre['IdLivre']); ?>" class="btn btn-outline-warning">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <h4 class="m-4 text-danger text-center">Pour toutes nos livres, veuillez consulter la section "Catégorie Livres" dans l'accueil.</h4>
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