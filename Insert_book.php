<?php
$conn = new mysqli("localhost", "root", "", "bibliotheque");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie = $_POST['categorie'];
    $resume = $_POST['resume'];

    // Gérer l'upload de la couverture
    $couverture = $_FILES['couverture']['name'];
    $target_dir_cover = "FILES/cover/";
    $target_file_cover = $target_dir_cover . basename($couverture);
    move_uploaded_file($_FILES['couverture']['tmp_name'], $target_file_cover);

    // Gérer l'upload du fichier PDF
    $fichier = $_FILES['fichier']['name'];
    $target_dir_file = "FILES/file/";
    $target_file_file = $target_dir_file . basename($fichier);
    move_uploaded_file($_FILES['fichier']['tmp_name'], $target_file_file);

    $stmt = $conn->prepare("INSERT INTO Livreetudiant (titre, auteur, categorie, fichier, couverture, resume) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $titre, $auteur, $categorie, $fichier, $couverture, $resume);

    
    if ($stmt->execute()) {
        echo "Livre inséré avec succès!";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre étudiant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container{
            border: 4px solid red;
        }
    </style>
</head>
<body>

<div class="container mt-5 col-md-6 bg-info-subtle">
    <h2 class="text-primary text-center">Ajouter un Livre étudiant</h2>
    <form id="bookForm" action="Insert_book.php" method="POST" enctype="multipart/form-data">
        <div class="bg-secondary-subtle">
        <div class="text-white ">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="auteur">Auteur</label>
                <input type="text" class="form-control" id="auteur" name="auteur" required>
            </div>
            
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select class="form-control" id="categorie" name="categorie" required>
                    <option value="">Sélectionner une catégorie</option>
                    <!-- Les catégories seront ajoutées ici dynamiquement -->
                    <?php
require_once('connexion.php'); // Assurez-vous que ce fichier contient les informations de connexion à la base de données

// Préparer la requête pour récupérer les catégories
$query = "SELECT idCategorie, name FROM categorie"; // Ajustez les noms des colonnes si nécessaire

// Exécuter la requête
$result = $conn->query($query);

// Vérifier si des catégories ont été trouvées
if ($result->num_rows > 0) {
    // Afficher chaque catégorie comme une option
    while ($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['idCategorie'].'">'.$row['name'].'</option>';
    }
} else {
    // Option vide si aucune catégorie n'est trouvée
    echo '<option value="">Aucune catégorie trouvée</option>';
}

// Fermer la connexion (facultatif, car il se fermera à la fin du script)
$conn->close();
?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="fichier">Fichier (PDF, EPUB, etc.)</label>
                <input type="file" class="form-control" id="fichier" name="fichier" required>
            </div>
            <div class="form-group">
                <label for="couverture">Couverture (Image PNG/JPG)</label>
                <input type="file" class="form-control" id="couverture" name="couverture" accept="image/png, image/jpeg, image/jpg" required>
            </div>
            <div class="form-group">
                <label for="resume">Résumé</label>
                <textarea class="form-control" id="resume" name="resume" rows="3"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Récupérer les catégories au chargement de la page
        fetch('get_categories.php')
            .then(response => response.json())
            .then(data => {
                const categorySelect = document.getElementById('categorie');
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.idCategorie; // Utiliser idCategorie comme valeur
                    option.text = category.name; // Utiliser name comme texte de l'option
                    categorySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des catégories:', error));
    });
   



