<?php
$conn = new mysqli("localhost", "root", "", "bibliotheque");

if (isset($_GET['subcategory_id'])) {
    $subcategory_id = $_GET['subcategory_id'];
    $books = $conn->query("SELECT * FROM livres WHERE SubCategorie = $subcategory_id");
    
    $booksArray = array();
    while ($row = $books->fetch_assoc()) {
        $booksArray[] = $row;
    }

    echo json_encode($booksArray);
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livres par sous-catégorie</title>
    <style>
        .book {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
        }
        .book img {
            max-width: 150px;
        }
    </style>
</head>
<body>
    <h1>Livres dans la sous-catégorie</h1>
    <div id="books-container"></div>

    <script>
        // Récupérer l'ID de la sous-catégorie depuis l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const subcategory_id = urlParams.get('subcategory_id');

        // Fonction pour afficher les livres
        function displayBooks(books) {
            const container = document.getElementById('books-container');
            container.innerHTML = '';

            books.forEach(book => {
                const bookDiv = document.createElement('div');
                bookDiv.className = 'book';
                bookDiv.innerHTML = `
                    <h2>${book.Titre}</h2>
                    <p>Auteur: ${book.Auteur}</p>
                    <p>Catégorie: ${book.Categorie}</p>
                    <p>Prix: ${book.Prix}</p>
                    <img src="uploads/covers/${book.Couverture}" alt="${book.Titre}">
                    <p>Résumé: ${book.Resume}</p>
                    <a href="uploads/files/${book.Fichier}" target="_blank">Lire le livre</a>
                    <p>Date de publication: ${book.DateEdit}</p>
                `;
                container.appendChild(bookDiv);
            });
        }

        // Récupérer les livres depuis get_books.php
        fetch(`get_books.php?subcategory_id=${subcategory_id}`)
            .then(response => response.json())
            .then(data => {
                displayBooks(data);
            });
    </script>
</body>
</html>
