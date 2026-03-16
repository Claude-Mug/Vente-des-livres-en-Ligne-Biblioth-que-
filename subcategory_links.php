<?php
$conn = new mysqli("localhost", "root", "", "bibliotheque");

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupérer les sous-catégories
$subcategories = $conn->query("SELECT id, name FROM SubCategorie");
while ($row = $subcategories->fetch_assoc()) {
    echo '<a href="display_books.php?subcategory_id='.$row['id'].'">Voir les livres dans la sous-catégorie '.$row['name'].'</a><br>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bibliothèque</title>
</head>
<body>
    <h1>Bienvenue à la Bibliothèque</h1>
    <h2>Sous-catégories</h2>
    <?php include 'subcategory_links.php'; ?>
</body>
</html>
