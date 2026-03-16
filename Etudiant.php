
<?php
// Connexion à la base de données
$servername = "localhost"; // Changer si nécessaire
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$dbname = "bibliotheque"; // Nom de la base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection échouée : " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
    </style>
</head>
<body>
    <header class="bg-secondary text-white text-center py-2 col-mt-6">
        <h1>Livres Étudiant</h1>
    </header>
    <div class="container mt-4">
        <div class="content">
            <p class="text-danger">Chers lecteurs, nous savons combien il est important pour vous de trouver des livres intéressants et utiles dans votre parcours académique. C'est pourquoi nous avons mis en place cette section dédiée aux étudiants, où vous trouverez une sélection de livres gratuits sur divers sujets.</p>
            <p>Que vous soyez à la recherche d'ouvrages sur le développement personnel, les sciences, la littérature ou d'autres domaines, vous pouvez parcourir notre collection. Nous espérons que ces ressources vous aideront à enrichir vos connaissances et à réussir dans vos études.</p>
            <p>N'hésitez pas à explorer les différents domaines de livres disponibles dans la section de gauche. Chaque livre a été choisi pour son utilité et son intérêt pour les étudiants comme vous.</p>
        </div>
        <div class="row mt-4">
            <div class="col text-center">
                <a href="#" class="btn btn-primary">Nous Suivre</a>
            </div>
            <div class="col text-center">
                <a href="#" class="btn btn-secondary">Créer un Compte</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

// Requête pour récupérer les livres
$sql = "SELECT * FROM livreetudiant";
$result = $conn->query($sql);

// Vérifier si des résultats sont retournés
if ($result->num_rows > 0) {
    echo "<div style='display: flex; flex-wrap: wrap; justify-content: space-between;'>";

    // Sortie des données de chaque ligne
    $count = 0; // Compteur pour afficher 3 livres par ligne
    while ($row = $result->fetch_assoc()) {
        if ($count % 3 == 0 && $count > 0) {
            echo "</div><div style='display: flex; flex-wrap: wrap; justify-content: space-between;'>"; // Nouvelle ligne après 3 livres
        }

        // Afficher les informations du livre
        echo "<div style='border: 1px solid #ddd; margin: 10px; padding: 10px; width: 30%;'>";
        echo "<h3>" . htmlspecialchars($row['titre']) . "</h3>";
        echo "<p>Auteur: " . htmlspecialchars($row['auteur']) . "</p>";
        echo "<p>Catégorie: " . htmlspecialchars($row['categorie']) . "</p>";
        echo "<p>Résumé: " . htmlspecialchars($row['resume']) . "</p>";

        // Affichage de la couverture
        $couverturePath = 'FILES/cover/' . htmlspecialchars($row['couverture']);
        echo "<img src='" . $couverturePath . "' alt='Couverture' style='width: 200px; height:auto;'><br>";

       // Chemin vers le fichier
       $fichierPath = 'FILE/file/' . htmlspecialchars($row['fichier']);

      // Bouton pour télécharger le fichier
      echo "<a href='" . $fichierPath . "' class='btn btn-success' download>Télécharger</a> ";

      // Bouton pour lire le fichier
      echo "<a href='#' class='btn btn-primary' onclick=\"openInNewTab('" . $fichierPath . "'); return false;\">Lire</a> ";

     // Bouton modifier
     echo "<a href='Modifier.php?idLiv=" . htmlspecialchars($row['idLiv']) . "' class='btn btn-warning'>Modifier</a>";

     echo "</div>";
  
        $count++;
    }
    echo "</div>"; // Fermer la dernière ligne
} else {
    echo "Aucun livre trouvé.";
}

// Bouton pour ajouter un livre
echo "<div style='margin-top: 20px;'>";
echo " <p class='text-danger'>Nous avons ajouté un bouton 'Ajouter livre' pour encourager nos utilisateurs à contribuer à notre collection. En partageant vos lectures et vos idées, vous pouvez aider non seulement les autres lecteurs à découvrir de nouveaux ouvrages, mais aussi enrichir notre base de données avec des titres qui vous ont marqué. Ensemble, nous pouvons créer une ressource précieuse et collaborative qui profite à toute la communauté. </p>";
echo "<a href='Insert_book.php' class='btn btn-secondary btn-center'>Ajouter un livre</a>";

echo "</div>";



// Fermer la connexion
$conn->close();

?>

<script>
function openInNewTab(url) {
    var win = window.open(url, '_blank'); // Ouvre l'URL dans un nouvel onglet
    if (win) {
        win.focus(); // Focalise le nouvel onglet
    } else {
        alert('Veuillez autoriser les pop-ups pour ouvrir le document.'); // Alerte si le pop-up est bloqué
    }
}
</script>

