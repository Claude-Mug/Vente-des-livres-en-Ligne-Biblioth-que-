<?php
$conn = new mysqli("localhost", "root", "", "bibliotheque");

if (isset($_GET['subcategory_id'])) {
    $subcategory_id = $_GET['subcategory_id'];
    $books = $conn->query("SELECT * FROM livres WHERE SubCategorie = $subcategory_id");

    if ($books->num_rows > 0) {
        echo "<h1>Livres dans la sous-catégorie</h1>";
        while ($row = $books->fetch_assoc()) {
            echo "<h2>".$row['Titre']."</h2>";
            echo "<p>Auteur: ".$row['Auteur']."</p>";
            echo "<p>Catégorie: ".$row['Categorie']."</p>";
            echo "<p>Prix: ".$row['Prix']."</p>";
            echo "<img src='uploads/covers/".$row['Couverture']."' alt='".$row['Titre']."'><br>";
            echo "<p>Résumé: ".$row['Resume']."</p>";
            echo "<a href='uploads/files/".$row['Fichier']."'>Télécharger le fichier</a><br>";
            echo "<p>Date de publication: ".$row['DateEdit']."</p>";
            echo "<hr>";
        }
    } else {
        echo "Aucun livre trouvé dans cette sous-catégorie.";
    }
} else {
    echo "Aucune sous-catégorie sélectionnée.";
}

$conn->close();
?>

