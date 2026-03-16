<?php
session_start();
if (!isset($_SESSION['idClient'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les livres payés par le client
$idClient = $_SESSION['idClient'];
$query = "SELECT l.Titre, l.Fichier, lp.statut, lp.message 
          FROM livres_payer lp
          JOIN livres l ON lp.idLivre = l.IdLivre
          WHERE lp.idClient = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idClient);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Confirmation de paiement</title>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Confirmation de paiement</h1>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Titre']); ?></td>
                        <td>
                            <?php
                            if ($row['statut'] === 'confirme') {
                                echo '<span class="badge badge-success">Confirmé</span>';
                            } elseif ($row['statut'] === 'refuse') {
                                echo '<span class="badge badge-danger">Refusé</span>';
                            } else {
                                echo '<span class="badge badge-warning">En attente</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($row['statut'] === 'confirme'): ?>
                                <a href="uploads/files/<?php echo htmlspecialchars($row['Fichier']); ?>" class="btn btn-success" download>Télécharger</a>
                                <a href="uploads/files/<?php echo htmlspecialchars($row['Fichier']); ?>" target="_blank" class="btn btn-primary">Lire</a>
                            <?php elseif ($row['statut'] === 'refuse'): ?>
                                <p class="text-danger"><?php echo htmlspecialchars($row['message']); ?></p>
                            <?php else: ?>
                                <span class="text-muted">En attente de confirmation</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun livre payé pour le moment.</p>
    <?php endif; ?>

    <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
</div>
</body>
</html>

<?php
$conn->close();
?>