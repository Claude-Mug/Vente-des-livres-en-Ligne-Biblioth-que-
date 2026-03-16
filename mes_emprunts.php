<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idClient'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$idClient = $_SESSION['idClient'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les emprunts de l'utilisateur avec les détails des livres
$empruntsQuery = "SELECT e.id, e.idLivre, e.date_emprunt, e.date_retour, e.statut, e.message_refus, l.Titre, l.Auteur 
                  FROM emprunts e 
                  JOIN livres l ON e.idLivre = l.IdLivre 
                  WHERE e.idClient = ?";
$stmt = $conn->prepare($empruntsQuery);
$stmt->bind_param("i", $idClient);
$stmt->execute();
$emprunts = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Mes emprunts</title>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Mes emprunts</h1>

    <table class="table table-bordered">
        <thead class="bg-success">
            <tr>
                <th>Livre</th>
                <th>Auteur</th>
                <th>Date d'emprunt</th>
                <th>Date de retour</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($emprunt = $emprunts->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($emprunt['Titre']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['Auteur']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['date_emprunt']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['date_retour']); ?></td>
                    <td><?php echo htmlspecialchars($emprunt['statut']); ?></td>
                    <td>
                        <?php if ($emprunt['statut'] === 'accepte'): ?>
                            <a href="lire_livre.php?id=<?php echo htmlspecialchars($emprunt['idLivre']); ?>" class="btn btn-primary">Lire</a>
                        <?php elseif ($emprunt['statut'] === 'refuse' && !empty($emprunt['message_refus'])): ?>
                            <div class="alert alert-danger">
                                <strong>Raison du refus :</strong> <?php echo htmlspecialchars($emprunt['message_refus']); ?>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="Panier.php" class="btn btn-primary">Retour</a>
</div>
</body>
</html>

<?php
$conn->close();
?>