<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Traitement des actions (Accepter ou Refuser)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $idEmprunt = $_POST['idEmprunt'];
        $messageRefus = isset($_POST['message_refus']) ? $_POST['message_refus'] : null;

        if ($_POST['action'] === 'accepter') {
            // Mettre à jour le statut à "accepte"
            $updateQuery = "UPDATE emprunts SET statut = 'accepte', message_refus = NULL WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("i", $idEmprunt);
        } elseif ($_POST['action'] === 'refuser') {
            // Mettre à jour le statut à "refuse" et enregistrer le message de refus
            $updateQuery = "UPDATE emprunts SET statut = 'refuse', message_refus = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("si", $messageRefus, $idEmprunt);
        }

        if ($stmt->execute()) {
            $message = "Action effectuée avec succès.";
        } else {
            $erreur = "Erreur lors de l'exécution de l'action : " . $stmt->error;
        }
    }
}

// Récupérer tous les emprunts avec les détails des clients et des livres
$empruntsQuery = "SELECT e.id, e.idClient, e.idLivre, e.date_emprunt, e.date_retour, e.statut, e.message_refus, 
                         c.Nom, c.Prenom, l.Titre 
                  FROM emprunts e 
                  JOIN client c ON e.idClient = c.IdClient 
                  JOIN livres l ON e.idLivre = l.IdLivre";
$emprunts = $conn->query($empruntsQuery);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gestion des emprunts</title>
    <style>
        .message-refus {
            display: none; /* Masquer par défaut */
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Gestion des emprunts</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (isset($erreur)): ?>
        <div class="alert alert-danger"><?php echo $erreur; ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client</th>
                <th>Livre</th>
                <th>Date d'emprunt</th>
                <th>Date de retour</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($emprunt = $emprunts->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($emprunt['Prenom'] . ' ' . htmlspecialchars($emprunt['Nom'])); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['Titre']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['date_emprunt']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['date_retour']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['statut']); ?></td>
                    <td>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="idEmprunt" value="<?php echo htmlspecialchars($emprunt['id']); ?>">
                            <button type="submit" name="action" value="accepter" class="btn btn-success btn-sm">Accepter</button>
                            <button type="button" class="btn btn-danger btn-sm btn-refuser" data-id="<?php echo htmlspecialchars($emprunt['id']); ?>">Refuser</button>
                            <div class="message-refus" id="message-refus-<?php echo htmlspecialchars($emprunt['id']); ?>">
                                <textarea name="message_refus" rows="2" placeholder="Raison du refus" class="form-control"></textarea>
                                <button type="submit" name="action" value="refuser" class="btn btn-warning btn-sm mt-2">Confirmer le refus</button>
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    // Afficher le champ de message de refus lorsque le bouton "Refuser" est cliqué
    document.querySelectorAll('.btn-refuser').forEach(button => {
        button.addEventListener('click', function() {
            const idEmprunt = this.getAttribute('data-id');
            const messageRefusDiv = document.getElementById(`message-refus-${idEmprunt}`);
            messageRefusDiv.style.display = messageRefusDiv.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>

</body>
</html>

<?php
$conn->close();
?>