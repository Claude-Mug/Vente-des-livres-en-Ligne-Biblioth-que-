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
    <title>Vente de Livres</title>
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

<div class="container mt-5">
    <h1 class="mb-4">Ajouter un Livre</h1>
    <form id="bookForm">
        <div class="mb-3">
            <label for="bookTitle" class="form-label">Titre du Livre</label>
            <input type="text" class="form-control" id="bookTitle" required>
        </div>
        <div class="mb-3">
            <label for="bookFile" class="form-label">Fichier PDF</label>
            <input type="file" class="form-control" id="bookFile" accept=".pdf" required>
        </div>
        <div class="mb-3">
            <label for="bookImage" class="form-label">Image de Couverture</label>
            <input type="file" class="form-control" id="bookImage" accept="image/*" >
        </div>
        <div class="mb-3">
            <label for="bookDescription" class="form-label">Description</label>
            <textarea class="form-control" id="bookDescription" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <div class="mb-3">
                <label for="currency" class="form-label">Devise</label>
                <select class="form-control" id="currency">
                    <option value="€">€ Euro</option>
                    <option value="$">$ Dollar</option>
                    <option value="£">£ Fbu</option>
                </select>
            </div>
            <input type="number" class="form-control" id="bookPrice" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter le Livre</button>
    </form>

    <h2 class="mt-5">Livres Disponibles</h2>
    <div id="bookList" class="row"></div>
</div>

<script>
    const bookForm = document.getElementById('bookForm');
    const bookList = document.getElementById('bookList');

    bookForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const title = document.getElementById('bookTitle').value;
        const file = document.getElementById('bookFile').files[0];
        const imageFile = document.getElementById('bookImage').files[0];
        const description = document.getElementById('bookDescription').value;
        const price = document.getElementById('bookPrice').value;

        const reader = new FileReader();
        const imageReader = new FileReader();

        // Lire le PDF pour l'utiliser plus tard
        reader.onload = function(e) {
            const bookDiv = document.createElement('div');
            bookDiv.className = 'col-md-4 mb-4';

            imageReader.onload = function(imageEvent) {
                bookDiv.innerHTML = `
                    <div class="card book-card" onclick="toggleDetails(this)">
                        <img src="${imageEvent.target.result}" class="card-img-top" alt="${title}">
                        <div class="card-body">
                            <h5 class="card-title">${title}</h5>
                            <p class="card-text">${description}</p>
                            <p class="card-text"><strong>Prix: ${price} $</strong></p>
                            <button class="btn btn-info" onclick="viewBook('${e.target.result}')">Lire un extrait</button>
                            <div class="book-details">
                                <p>Plus de détails sur "${title}"...</p>
                            </div>
                        </div>
                    </div>
                `;

                bookList.appendChild(bookDiv);
            }

            imageReader.readAsDataURL(imageFile);
        }

        reader.readAsDataURL(file);
    });

    function toggleDetails(element) {
        const details = element.querySelector('.book-details');
        details.style.display = details.style.display === 'none' ? 'block' : 'none';
    }

    function viewBook(fileDataURL) {
        const pdfWindow = window.open();
        pdfWindow.location = fileDataURL; // Ouvre le PDF dans un nouvel onglet
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>