<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur
$password = ""; // Remplacez par votre mot de passe
$dbname = "bibliotheque"; // Nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer tous les livres
$sql = "SELECT IdLivre, Titre FROM livres";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bibliothèque</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .livre {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Liste des Livres</h1>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="livre">
                <h3><?php echo htmlspecialchars($row['Titre']); ?></h3>
                <a href="lire.php?id=<?php echo $row['IdLivre']; ?>" class="btn">Lire</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Aucun livre trouvé.</p>
    <?php endif; ?>
</body>
</html>