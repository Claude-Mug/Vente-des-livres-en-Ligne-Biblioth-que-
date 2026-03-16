<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['Titre']);
    $author = $conn->real_escape_string($_POST['Auteur']);
    $categoryId = $conn->real_escape_string($_POST['categorie']); // ID de la catégorie

    // Récupérer le nom de la catégorie
    $categoryQuery = "SELECT name FROM categorie WHERE idCategorie='$categoryId'";
    $categoryResult = $conn->query($categoryQuery);
    
    if ($categoryResult->num_rows > 0) {
        $categoryRow = $categoryResult->fetch_assoc();
        $categoryName = $categoryRow['name']; // Récupérer le nom de la catégorie
    } else {
        die("Erreur : Catégorie non trouvée.");
    }

    $price = $_POST['Prix'];
    $currency = $_POST['Devise'];
    $idlivre = $_POST['IdLivre'];
    $description = $conn->real_escape_string($_POST['Resume']);
    $dateEdit = $_POST['dateEdit'];

    // Vérifier si IdLivre existe déjà
    $idCheck = "SELECT IdLivre FROM livres WHERE IdLivre='$idlivre'";
    $idResult = $conn->query($idCheck);
    if ($idResult->num_rows > 0) {
        die("Erreur : IdLivre existe déjà.");
    }

    // Traitement du fichier PDF
    if (isset($_FILES['file'])) {
        $file = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        if (!move_uploaded_file($file_tmp, "uploads/files/" . $file)) {
            die("Erreur lors du téléchargement du fichier PDF.");
        }
    } else {
        die("Erreur : fichier PDF manquant.");
    }

    // Traitement de l'image de couverture
    if (isset($_FILES['cover'])) {
        $cover = $_FILES['cover']['name'];
        $cover_tmp = $_FILES['cover']['tmp_name'];
        if (!move_uploaded_file($cover_tmp, "uploads/covers/" . $cover)) {
            die("Erreur lors du téléchargement de l'image de couverture.");
        }
    } else {
        die("Erreur : image de couverture manquante.");
    }

    // Insertion des données dans la base de données
    $sql = "INSERT INTO livres (Titre, Auteur, Categorie, Prix, Devise, IdLivre, Fichier, Couverture, Resume, DateEdit) 
            VALUES ('$title', '$author', '$categoryName', '$price', '$currency', '$idlivre', '$file', '$cover', '$description', '$dateEdit')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouveau livre ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>