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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Ajouter un nouveau livre</h2>
    <form action="insert_book.php" method="post" enctype="multipart/form-data">
    <label for="title">Titre:</label>
    <input type="text" id="title" name="title" required><br><br>
    
    <label for="author">Auteur:</label>
    <input type="text" id="author" name="author" required><br><br>
    
    <label for="category">Catégorie:</label>
<select id="category" name="category" required>
    <?php
    $conn = new mysqli("localhost", "root", "", "bibliotheque");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }

    // Récupérer les catégories
    $categories = $conn->query("SELECT DISTINCT category FROM SubCategorie");
    while ($row = $categories->fetch_assoc()) {
        echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';
    }
    ?>
</select><br><br>

<label for="subcategory">Sous-catégorie:</label>
<select id="subcategory" name="subcategory" required>
    <?php
    // Récupérer les sous-catégories
    $subcategories = $conn->query("SELECT id, name FROM SubCategorie");
    while ($row = $subcategories->fetch_assoc()) {
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }

    // Fermer la connexion
    $conn->close();
    ?>
</select><br><br>

    
    <label for="price">Prix:</label>
    <input type="number" id="price" name="price" step="0.01" required><br><br>
    
    <label for="cover">Couverture (Image):</label>
    <input type="file" id="cover" name="cover" accept="image/*" required><br><br>
    
    <label for="file">Fichier (PDF):</label>
    <input type="file" id="file" name="file" accept="application/pdf" required><br><br>
    
    <label for="description">Résumé:</label>
    <textarea id="description" name="description" required></textarea><br><br>
    
    <label for="dateEdit">Date de publication:</label>
    <input type="date" id="dateEdit" name="dateEdit" required><br><br>
    
    <input type="submit" value="Insérer le livre">
</form>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Script pour remplir dynamiquement les sous-catégories en fonction de la catégorie sélectionnée
    $('#category').change(function() {
        var categoryId = $(this).val();
        $.ajax({
            url: 'get_subcategories.php',
            type: 'POST',
            data: { category_id: categoryId },
            success: function(response) {
                $('#subcategory').html(response);
            }
        });
    });
</script>
</body>
</html>

<?php
$conn = new mysqli("localhost", "root", "", "bibliotheque");

// Récupérer les catégories
$categories = $conn->query("SELECT DISTINCT category FROM SubCategorie");
echo '<select id="category" name="category">';
while ($row = $categories->fetch_assoc()) {
    echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';
}
echo '</select>';

// Récupérer les sous-catégories
$subcategories = $conn->query("SELECT * FROM SubCategorie");
echo '<select id="subcategory" name="subcategory">';
while ($row = $subcategories->fetch_assoc()) {
    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
}
echo '</select>';
?>



