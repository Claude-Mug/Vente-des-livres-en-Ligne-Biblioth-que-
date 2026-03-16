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
    <title>Livres Graphisme et Photos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Livres Graphisme et Photos</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Graphisme</h2>
            <p>Le graphisme est l'art de communiquer visuellement à travers des images, des typographies et des mises en page. Les livres sur le graphisme abordent les principes de design, l'utilisation des couleurs et les tendances actuelles dans le domaine.</p>
        </div>
        <div class="mb-4">
            <h2>Design Graphique</h2>
            <p>Le design graphique combine créativité et technologie pour créer des visuels percutants. Les ouvrages sur ce sujet explorent les logiciels de design, les techniques de création et les études de cas de projets réussis.</p>
        </div>
        <div class="mb-4">
            <h2>Photographie</h2>
            <p>La photographie est un art qui capture des moments à travers l'objectif. Les livres sur la photographie traitent des techniques de prise de vue, de composition, d'éclairage et de retouche, aidant les photographes à améliorer leurs compétences.</p>
        </div>
        <div class="mb-4">
            <h2>Photographie de Portrait</h2>
            <p>La photographie de portrait se concentre sur la capture de l'essence humaine. Les ouvrages sur ce sujet offrent des conseils sur la direction des modèles, l'éclairage et la composition, permettant aux photographes de créer des portraits mémorables.</p>
        </div>
        <div class="mb-4">
            <h2>Photographie de Paysage</h2>
            <p>La photographie de paysage met en valeur la beauté de la nature. Les livres sur ce domaine abordent des techniques spécifiques pour capturer des paysages, des conseils sur la planification des prises de vue et l'utilisation de l'équipement adapté.</p>
        </div>
        <div class="mb-4">
            <h2>Création de Contenu Visuel</h2>
            <p>La création de contenu visuel est essentielle dans le monde numérique. Les ouvrages sur ce sujet explorent les meilleures pratiques pour produire des images et des graphiques qui captivent l'audience sur les réseaux sociaux et autres plateformes.</p>
        </div>
        <div class="mb-4">
            <h2>Retouche et Édition</h2>
            <p>La retouche photo et l'édition sont des étapes cruciales dans le processus photographique. Les livres sur ce sujet traitent des logiciels de retouche, des techniques d'édition et des conseils pour améliorer la qualité des images finales.</p>
        </div>
        <div class="mb-4">
            <h2>Typographie</h2>
            <p>La typographie est un élément fondamental du design graphique. Les ouvrages sur la typographie abordent l'histoire, les styles de police et les principes d'utilisation des caractères dans le graphisme, permettant aux designers de créer des compositions visuellement harmonieuses.</p>
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

    // Requête pour obtenir les livres de la catégorie "Graphisme"
    $sql = "SELECT IdLivre, Titre, Auteur, Categorie, SubCategorie, Prix, Devise, Couverture, Resume, Fichier 
            FROM livres 
            WHERE Categorie = :categorie";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['categorie' => 'Graphisme']);

    // Affichage des résultats
    if ($stmt->rowCount() > 0) {
        echo "<h2>Livres de la catégorie Graphisme et Photo</h2>"; // Mise à jour du titre
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
            echo "<a href='emprunter_livre.php?id=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-outline-danger m-1'>Emprunter</a>";
            echo "</div></div></div>";
        }
        echo "</div>";
    } else {
        echo "Aucun livre trouvé dans la catégorie Graphisme et photo."; // Mise à jour du message
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