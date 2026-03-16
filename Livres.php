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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout des Livres vente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-card {
            cursor: pointer;
        }
        .book-details {
            display: none;
        }
    </style>
</head>
<body>

<div class="container mt-5 col-6 bg-danger-subtle">
    <h1 class="mb-4 text-primary">Ajouter un Livre a Vendre</h1>
    <form id="bookForm" method="POST" enctype="multipart/form-data" action="ajouter.php">
        <div class="mb-3">
            <label for="bookTitle" class="form-label">Titre du Livre</label>
            <input type="text" class="form-control" id="bookTitle" name="Titre" required>
        </div>
        <div class="mb-3">
            <label for="bookAuthor" class="form-label">Auteur</label>
            <input type="text" class="form-control" id="bookAuthor" name="Auteur" required>
        </div>
        <div class="mb-3">
            <label for="bookCategory" class="form-label">Catégorie</label>
            <select class="form-control" id="bookCategory" name="categorie" required>
                <option value="">Sélectionner une catégorie</option>
                <?php
           require_once('connexion.php'); // Assurez-vous que ce fichier contient les informations de connexion à la base de données

            // Préparer la requête pour récupérer les catégories
           $query = "SELECT idCategorie, name FROM categorie"; // Ajustez les noms des colonnes si nécessaire
           $result = $conn->query($query);
          // Vérifier si des catégories ont été trouvées
          if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
          echo '<option value="'.$row['idCategorie'].'">'.$row['name'].'</option>';
          }
        } else {
           echo '<option value="">Aucune catégorie trouvée</option>';
       }
      ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="bookPrice" class="form-label">Prix</label>
            <div class="input-group">
                <input type="number" class="form-control" id="bookPrice" name="Prix" step="0.01" required>
                <select class="form-control" id="bookCurrency" name="Devise" required>
                    <option value="USD">$</option>
                    <option value="EUR">€</option>
                    <option value="Fbu">Fbu</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="bookId" class="form-label">IdLivre</label>
            <input type="number" class="form-control" id="bookId" name="IdLivre">
        </div>
        <div class="mb-3">
            <label for="bookFile" class="form-label">Fichier PDF</label>
            <input type="file" class="form-control" id="bookFile" name="file" accept=".pdf" required>
        </div>
        <div class="mb-3">
            <label for="bookImage" class="form-label">Image de Couverture</label>
            <input type="file" class="form-control" id="bookImage" name="cover" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="bookDescription" class="form-label">Résumé</label>
            <textarea class="form-control" id="bookDescription" name="Resume" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="dateEdit" class="form-label">Date de Publication</label>
            <input type="date" class="form-control" id="dateEdit" name="dateEdit" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter le Livre</button>
    </form>

    <h2 class="mt-5">Livres Disponibles</h2>
    <div id="bookList" class="row"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Récupérer les catégories au chargement de la page
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

    const bookForm = document.getElementById('bookForm');
    const bookList = document.getElementById('bookList');

    bookForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(bookForm);

        fetch('ajouter.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            fetchBooks(); // Actualiser la liste des livres après l'insertion
        });
    });

    function fetchBooks() {
        fetch('get_books.php?subcategory_id=1') // Exemple avec la sous-catégorie ID 1
            .then(response => response.json())
            .then(data => {
                displayBooks(data);
            });
    }

    function displayBooks(books) {
        bookList.innerHTML = '';

        books.forEach(book => {
            const bookDiv = document.createElement('div');
            bookDiv.className = 'col-md-4 mb-4';

            bookDiv.innerHTML = `
                <div class="card book-card" onclick="toggleDetails(this)">
                    <img src="uploads/covers/${book.Couverture}" class="card-img-top" alt="${book.Titre}">
                    <div class="card-body">
                        <h5 class="card-title">${book.Titre}</h5>
                        <p class="card-text">${book.Resume}</p>
                        <p class="card-text"><strong>Prix: ${book.Prix}</strong></p>
                        <button class="btn btn-info" onclick="viewBook('uploads/files/${book.Fichier}')">Lire un extrait</button>
                        <div class="book-details">
                            <p>Plus de détails sur "${book.Titre}"...</p>
                        </div>
                    </div>
                </div>
            `;

            bookList.appendChild(bookDiv);
        });
    }

    function toggleDetails(element) {
        const details = element.querySelector('.book-details');
        details.style.display = details.style.display === 'none' ? 'block' : 'none';
    }

    function viewBook(fileUrl) {
        const pdfWindow = window.open();
        pdfWindow.location = fileUrl; // Ouvre le PDF dans un nouvel onglet
    }

    fetchBooks(); // Charger les livres au chargement de la page
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
require_once('connexion.php'); // Assurez-vous que le fichier de connexion existe et est correct

try {
    // Préparez la requête SQL pour sélectionner toutes les entrées de la table Livres avec les noms de catégories
    $res = "SELECT l.*, c.name AS CategorieName 
            FROM livres l 
            JOIN categorie c ON l.Categorie = c.Name"; // Assurez-vous que les noms des colonnes sont corrects
    $result = $connect->prepare($res);
    $result->execute();

    // Récupérez et affichez les résultats
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    
    // Démarrer le conteneur pour la mise en page
    echo "<div class='container mt-4'>";
    echo "<div class='row'>"; // Début de la ligne pour Bootstrap

    $count = 0; // Compteur pour afficher 3 livres par ligne
    foreach ($rows as $row) {
        // Créer une colonne pour chaque livre
        echo "<div class='col-md-4 mb-4'>"; // Colonne Bootstrap
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title text-primary '>" . htmlspecialchars($row['Titre']) . "</h5>";
        echo "<p>Auteur: " . htmlspecialchars($row['Auteur']) . "</p>";
        echo "<p>Catégorie: " . htmlspecialchars($row['CategorieName']) . "</p>"; // Afficher le nom de la catégorie
        echo "<p>Prix: " . htmlspecialchars($row['Prix']) . " " . htmlspecialchars($row['Devise']) . "</p>";
        echo "<p class='text-primary bg-opacity-50'>Résumé: " . htmlspecialchars($row['Resume']) . "</p>";
        echo "<img src='uploads/covers/" . htmlspecialchars($row['Couverture']) . "' alt='Couverture du livre' style='width:50%; height:auto;'><br>";
        
        // Ajout des boutons
        echo "<a href='uploads/files/" . htmlspecialchars($row['Fichier']) . "' class='btn btn-success' download>Télécharger</a> ";
        echo "<a href='uploads/files/" . htmlspecialchars($row['Fichier']) . "' target='_blank' class='btn btn-primary'>Voir le PDF</a> ";
        echo "<a href='Ajoutpanier.php?id=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-warning m-2'>Ajouter au panier</a>";
        
        echo "</div>"; // Fin de card-body
        echo "</div>"; // Fin de card
        echo "</div>"; // Fin de col-md-4

        $count++;
        // Si 3 livres sont affichés, fermer la ligne et en ouvrir une nouvelle
        if ($count % 3 == 0) {
            echo "</div><div class='row'>"; // Nouvelle ligne
        }
    }

    echo "</div>"; // Fin de la dernière ligne
    echo "</div>"; // Fin du conteneur

} catch(PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>