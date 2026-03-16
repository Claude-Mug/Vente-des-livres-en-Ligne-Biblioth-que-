<?php
require 'db_connection.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_title = $_POST['book_title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $subcategory_id = $_POST['subcategory'];

    $sql = "INSERT INTO books (book_title, author, price, subcategory_id) VALUES ('$book_title', '$author', '$price', '$subcategory_id')";
    if (mysqli_query($conn, $sql)) {
        echo "Livre ajouté avec succès.";
    } else {
        echo "Erreur: " . mysqli_error($conn);
    }
}
?>
<a href="display_books.php?subcategory_id=1">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=2">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=3">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=4">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=5">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=5">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=6">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=7">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=8">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=9">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=10">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=11">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=12">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=13">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=14">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=15">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=16">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=17">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=18">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=19">Voir les livres dans la sous-catégorie 1</a>
<a href="display_books.php?subcategory_id=20">Voir les livres dans la sous-catégorie 1</a>
