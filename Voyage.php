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
    <title>Livres Voyage et Tourisme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center py-1">
        <h1>Livres Voyage et Tourisme</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Guides de Voyage</h2>
            <p>Les guides de voyage fournissent des informations pratiques sur les destinations, y compris les attractions, les restaurants et les conseils pour se déplacer. Ils sont essentiels pour planifier des vacances réussies et découvrir de nouveaux endroits.</p>
        </div>
        <div class="mb-4">
            <h2>Aventures et Expéditions</h2>
            <p>Ce domaine explore les voyages d'aventure, tels que le trekking, l'escalade et les expéditions dans des lieux reculés. Les livres sur ce sujet inspirent les lecteurs à sortir des sentiers battus et à vivre des expériences uniques.</p>
        </div>
        <div class="mb-4">
            <h2>Culture et Patrimoine</h2>
            <p>Les ouvrages sur la culture et le patrimoine examinent les traditions, l'histoire et les coutumes des différentes régions du monde. Ils aident les voyageurs à comprendre et à apprécier la richesse culturelle des destinations qu'ils visitent.</p>
        </div>
        <div class="mb-4">
            <h2>Voyages en Famille</h2>
            <p>Les livres sur les voyages en famille proposent des conseils pour planifier des vacances adaptées aux enfants. Ils abordent des destinations familiales, des activités amusantes et des astuces pour voyager avec des jeunes.</p>
        </div>
        <div class="mb-4">
            <h2>Écotourisme</h2>
            <p>L'écotourisme met l'accent sur des pratiques de voyage durables et respectueuses de l'environnement. Les ouvrages sur ce sujet explorent des destinations écologiques et des initiatives visant à préserver la nature tout en offrant des expériences authentiques.</p>
        </div>
        <div class="mb-4">
            <h2>Randonnées et Nature</h2>
            <p>Les livres sur les randonnées et la nature fournissent des informations sur les sentiers, les parcs nationaux et les expériences en plein air. Ils sont indispensables pour les amateurs de randonnée et de découverte de la nature.</p>
        </div>
        <div class="mb-4">
            <h2>Cuisine du Monde</h2>
            <p>La cuisine est une part essentielle de toute expérience de voyage. Les ouvrages sur la cuisine du monde explorent les plats typiques, les traditions culinaires et les recettes des différentes cultures, permettant aux lecteurs de voyager à travers les saveurs.</p>
        </div>
        <div class="mb-4">
            <h2>Conseils de Voyage</h2>
            <p>Les livres de conseils de voyage offrent des astuces pratiques pour préparer un voyage, gérer le budget, choisir l'hébergement et profiter au maximum de l'expérience. Ils sont essentiels pour tout voyageur souhaitant optimiser son séjour.</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Configuration de la base de données
$host = 'localhost'; // Serveur local
$dbname = 'bibliotheque'; // Nom de la base de données
$username = 'root'; // Utilisateur par défaut de XAMPP
$password = ''; // Mot de passe par défaut (vide pour XAMPP)

// Essayer de se connecter à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour obtenir les livres de la catégorie "Science"
    $sql = "SELECT IdLivre, Titre, Auteur, Categorie, SubCategorie, Prix, Devise, Couverture, Resume, Fichier 
            FROM livres 
            WHERE Categorie = :categorie";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['categorie' => 'Voyage et Tourisme']);

    // Affichage des résultats
    if ($stmt->rowCount() > 0) {
        echo "<h2>Livres de la catégorie Voyage et Tourisme</h2>"; // Mise à jour du titre
        echo "<div class='row'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='col-md-4'>";
            echo "<div class='card mb-4'>";
            echo "<img src='uploads/covers/" . htmlspecialchars($row['Couverture']) . "' class='card-img-top' alt='Couverture du livre'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($row['Titre']) . "</h5>";
            echo "<p class='card-text'>Auteur: " . htmlspecialchars($row['Auteur']) . "</p>";
            echo "<p class='card-text'>Prix: " . htmlspecialchars($row['Prix']) . " " . htmlspecialchars($row['Devise']) . "</p>";
            echo "<p class='card-text'>" . displayResume(htmlspecialchars($row['Resume'])) . "</p>";
            $fichier = 'uploads/files/' . htmlspecialchars($row['Fichier']);
            echo "<a href='lire.php?fichier=" . urlencode($fichier) . "' class='btn btn-outline-primary'>Lire</a> ";
            echo "<a href='panier.php?id=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-outline-success'>Ajouter au panier</a> ";
            echo "<a href='empreinter.php?id=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-outline-danger m-1'>Emprunter</a>";
            echo "</div></div></div>";
        }
        echo "</div>";
    } else {
        echo "Aucun livre trouvé dans la catégorie Voyage et Tourisme."; // Mise à jour du message
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Fonction pour afficher le résumé
function displayResume($resume) {
    $maxWords = 50; // Limite à 50 mots
    $words = explode(' ', $resume);
    
    if (count($words) > $maxWords) {
        $shortResume = implode(' ', array_slice($words, 0, $maxWords)) . '...';
        // Créez un ID unique pour chaque résumé
        $id = uniqid('resume_');
        return "<span id='$id' class='resume-short'>$shortResume</span> 
                <span id='{$id}_full' style='display:none;' class='resume-full'>$resume</span> 
                <a href='javascript:void(0)' class='voir-plus' data-id='$id'>Voir plus</a>";
    }
    return $resume; // Retourne le résumé complet si inférieur à 50 mots
}
?>

<!-- Style CSS -->
<style>
.card-img-top {
    width: 100%; /* Remplit la largeur du conteneur */
    height: 200px; /* Hauteur fixe pour uniformiser */
    object-fit: cover; /* Ajuste l'image pour couvrir tout l'espace */
}
</style>

<!-- Inclusion de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script JavaScript -->
<script>
$(document).ready(function() {
    $('.voir-plus').on('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        var id = $(this).data('id');
        var shortResume = $('#' + id);
        var fullResume = $('#' + id + '_full');
        
        if (shortResume.is(':visible')) {
            shortResume.hide();
            fullResume.show();
            $(this).text('Voir moins'); // Change le texte du lien
        } else {
            shortResume.show();
            fullResume.hide();
            $(this).text('Voir plus'); // Remet le texte d'origine
        }
    });
});
</script>