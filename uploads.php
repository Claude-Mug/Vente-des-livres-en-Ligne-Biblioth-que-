<?php
$conn = new mysqli("localhost", "root", "", "bibliotheque");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['title'];
    $auteur = $_POST['author'];
    $categorie = $_POST['category'];
    $subcategorie = $_POST['subcategory'];
    $prix = $_POST['price'];
    $resume = $_POST['description'];
    $dateEdit = $_POST['dateEdit'];

    // Gérer l'upload de la couverture
    $couverture = $_FILES['cover']['name'];
    $target_dir_cover = "uploads/covers/";
    $target_file_cover = $target_dir_cover . basename($couverture);
    
    if (move_uploaded_file($_FILES['cover']['tmp_name'], $target_file_cover)) {
        echo "La couverture a été uploadée avec succès.<br>";
    } else {
        echo "Erreur lors de l'upload de la couverture.<br>";
    }

    // Gérer l'upload du fichier PDF
    $fichier = $_FILES['file']['name'];
    $target_dir_file = "uploads/files/";
    $target_file_file = $target_dir_file . basename($fichier);
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file_file)) {
        echo "Le fichier a été uploadé avec succès.<br>";
    } else {
        echo "Erreur lors de l'upload du fichier.<br>";
    }

    $stmt = $conn->prepare("INSERT INTO livres (Titre, Auteur, Categorie, SubCategorie, Prix, Couverture, Resume, Fichier, DateEdit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisssss", $titre, $auteur, $categorie, $subcategorie, $prix, $couverture, $resume, $fichier, $dateEdit);
    
    if ($stmt->execute()) {
        echo "Livre ajouté avec succès.";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}
?>
