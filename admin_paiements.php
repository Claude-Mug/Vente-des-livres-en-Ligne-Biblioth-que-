<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Traitement du formulaire de confirmation ou refus
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['idLivrePayer'])) {
        $idLivrePayer = $_POST['idLivrePayer'];
        $action = $_POST['action'];
        $message = $_POST['message'] ?? ''; // Message en cas de refus

        // Mettre à jour le statut du paiement
        if ($action === 'confirmer') {
            $statut = 'confirme';
            $message = ''; // Pas de message pour une confirmation
        } elseif ($action === 'refuser') {
            $statut = 'refuse';
        }

        $updateQuery = "UPDATE livres_payer SET statut = ?, message = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssi", $statut, $message, $idLivrePayer);
        $stmt->execute();

        // Rediriger pour éviter la soumission multiple du formulaire
        header("Location: admin_paiements.php");
        exit();
    }
}

// Récupérer tous les livres en attente de confirmation
$query = "SELECT lp.id, l.Titre, c.Nom, c.Prenom, lp.date_paiement 
          FROM livres_payer lp
          JOIN livres l ON lp.idLivre = l.IdLivre
          JOIN client c ON lp.idClient = c.IdClient
          WHERE lp.statut = 'en_attente'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gestion des paiements</title>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Gestion des paiements</h1>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Client</th>
                    <th>Date de paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Titre']); ?></td>
                        <td><?php echo htmlspecialchars($row['Prenom'] . ' ' . $row['Nom']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_paiement']); ?></td>
                        <td>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="idLivrePayer" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="action" value="confirmer" class="btn btn-success btn-sm">Confirmer</button>
                            </form>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="idLivrePayer" value="<?php echo $row['id']; ?>">
                                <input type="text" name="message" placeholder="Raison du refus" required>
                                <button type="submit" name="action" value="refuser" class="btn btn-danger btn-sm">Refuser</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun livre en attente de confirmation.</p>
    <?php endif; ?>

    <a href="admin_dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>
</div>
</body>
</html>

<?php
$conn->close();
?>