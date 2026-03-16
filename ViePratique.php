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
    <title>Livres Vie Pratique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center py-1">
        <h1>Livres Vie Pratique</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Santé et bien-être</h2>
            <p>Les livres sur la santé et le bien-être abordent des sujets tels que la nutrition, la gestion du stress et le développement personnel. Ils offrent des conseils pratiques pour améliorer la qualité de vie et favoriser un mode de vie sain.</p>
        </div>
        <div class="mb-4">
            <h2>Spiritualité</h2>
            <p>La spiritualité explore des questions de sens et de connexion avec soi-même et les autres. Les ouvrages sur ce sujet incluent des pratiques méditatives, des philosophies de vie et des réflexions sur la nature de l'existence.</p>
        </div>
        <div class="mb-4">
            <h2>Sport - Forme - Beauté</h2>
            <p>Ce domaine couvre les activités sportives, le fitness et les soins de beauté. Les livres traitent des programmes d'entraînement, de la santé physique et des astuces pour prendre soin de soi, combinant bien-être physique et esthétique.</p>
        </div>
        <div class="mb-4">
            <h2>Vie de famille</h2>
            <p>Les livres sur la vie de famille abordent les dynamiques familiales, la parentalité et les relations intergénérationnelles. Ils fournissent des conseils pour renforcer les liens familiaux et naviguer dans les défis quotidiens.</p>
        </div>
        <div class="mb-4">
            <h2>Sexualité</h2>
            <p>La sexualité est un aspect fondamental de la vie humaine. Les ouvrages sur ce sujet traitent de l'éducation sexuelle, de la santé reproductive et des relations intimes, visant à promouvoir une approche saine et positive de la sexualité.</p>
        </div>
        <div class="mb-4">
            <h2>Séduction</h2>
            <p>Les livres sur la séduction explorent les arts de l'attraction et des relations amoureuses. Ils offrent des conseils sur la communication, la confiance en soi et les interactions sociales pour renforcer les connexions personnelles.</p>
        </div>
        <div class="mb-4">
            <h2>Couple</h2>
            <p>Les ouvrages sur le couple abordent les relations amoureuses, la communication et la gestion des conflits. Ils fournissent des outils pour construire des relations saines et durables, favorisant la compréhension et l'harmonie.</p>
        </div>
        <div class="mb-4">
            <h2>Cuisine, Trucs et astuces</h2>
            <p>Les livres de cuisine proposent des recettes et des techniques culinaires, tandis que les trucs et astuces aident à améliorer l'efficacité en cuisine. Ces ouvrages sont parfaits pour ceux qui souhaitent explorer leur créativité culinaire tout en simplifiant les tâches quotidiennes.</p>
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
    $stmt->execute(['categorie' => 'ViePratique']);

    // Affichage des résultats
    if ($stmt->rowCount() > 0) {
        echo "<h2>Livres de la catégorie Vie Pratique</h2>"; // Mise à jour du titre
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
        echo "Aucun livre trouvé dans la catégorie vie pratique."; // Mise à jour du message
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