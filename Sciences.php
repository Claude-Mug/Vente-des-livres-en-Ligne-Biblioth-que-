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
    <title>Livres Science</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclusion de Bootstrap 5 CSS et jQuery -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <header class="bg-dark text-white text-center py-1">
        <h1>Livres Science</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Mathématiques</h2>
            <p>Les mathématiques sont la langue des sciences. Elles fournissent des outils essentiels pour modéliser des phénomènes naturels, résoudre des problèmes complexes et analyser des données. Les ouvrages en mathématiques couvrent des domaines allant de l'arithmétique de base aux mathématiques avancées, en passant par la théorie des nombres, l'algèbre et le calcul différentiel.</p>
        </div>
        <div class="mb-4">
            <h2>Physique</h2>
            <p>La physique explore les lois fondamentales de l'univers. Elle aborde des concepts tels que la mécanique, l'électromagnétisme, la thermodynamique et la relativité. Les livres de physique sont conçus pour tous les niveaux, des introductions pour les débutants aux textes avancés qui traitent des recherches contemporaines.</p>
        </div>
        <div class="mb-4">
            <h2>Chimie</h2>
            <p>La chimie étudie la composition, la structure et les propriétés de la matière. Elle se divise en plusieurs branches, dont la chimie organique, inorganique, physique et analytique. Les livres sur la chimie sont essentiels pour comprendre les réactions chimiques, la synthèse des composés et les applications industrielles.</p>
        </div>
        <div class="mb-4">
            <h2>Sciences de la vie</h2>
            <p>Les sciences de la vie englobent l'étude des organismes vivants, de leur structure, de leur fonction et de leur interaction avec l'environnement. Ces ouvrages traitent de l'écologie, de la biologie moléculaire, de la génétique et de l'évolution, fournissant une compréhension approfondie des systèmes biologiques.</p>
        </div>
        <div class="mb-4">
            <h2>Biologie</h2>
            <p>La biologie est une branche des sciences de la vie, focalisée sur les êtres vivants et leurs processus. Les livres de biologie couvrent des sujets tels que la microbiologie, la zoologie, la botanique et la biologie cellulaire, offrant des connaissances essentielles pour les étudiants et les professionnels.</p>
        </div>
        <div class="mb-4">
            <h2>Sciences de la terre</h2>
            <p>Les sciences de la terre étudient la structure, la composition et les processus de la Terre. Cela inclut la géologie, la météorologie et l'océanographie. Ces livres aident à comprendre les phénomènes géologiques et les impacts environnementaux.</p>
        </div>
        <div class="mb-4">
            <h2>Physique de l'atmosphère et climatologie</h2>
            <p>Ce domaine examine les processus atmosphériques et leurs effets sur le climat. Les ouvrages en climatologie traitent des changements climatiques, des modèles climatiques et des impacts environnementaux, essentiels pour aborder les défis contemporains liés au climat.</p>
        </div>
        <div class="mb-4">
            <h2>Sismologie</h2>
            <p>La sismologie est l'étude des séismes et des ondes sismiques. Les livres sur ce sujet abordent la théorie des séismes, leur mesure et leur impact sur les structures humaines, offrant des connaissances cruciales pour la prévention des catastrophes.</p>
        </div>
        <div class="mb-4">
            <h2>Géologie</h2>
            <p>La géologie explore la composition, la structure et l'évolution de la Terre. Les ouvrages de géologie traitent des roches, des minéraux et des processus géologiques, fournissant des informations sur l'histoire de notre planète.</p>
        </div>
        <div class="mb-4">
            <h2>Techniques</h2>
            <p>Le domaine des techniques englobe les applications pratiques des sciences physiques et biologiques. Les livres techniques abordent les méthodes et outils utilisés dans divers secteurs, allant de l'ingénierie à la médecine.</p>
        </div>
        <div class="mb-4">
            <h2>Électricité et électrotechnique</h2>
            <p>L'électricité et l'électrotechnique traitent des principes de l'électricité, des circuits électriques et des systèmes électromagnétiques. Les ouvrages dans ce domaine sont cruciaux pour comprendre les technologies modernes et leurs applications dans l'industrie.</p>
        </div>
        <div class="mb-4">
            <h2>Électronique</h2>
            <p>L'électronique est la branche de l'ingénierie qui traite des dispositifs et systèmes utilisant des composants électroniques. Les livres sur l'électronique couvrent des sujets comme les circuits intégrés, la microélectronique et les systèmes embarqués, essentiels pour le développement de technologies modernes.</p>
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
    $stmt->execute(['categorie' => 'Science']);

    // Affichage des résultats
    if ($stmt->rowCount() > 0) {
        echo "<h2>Livres de la catégorie Science</h2>"; // Mise à jour du titre
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
        echo "Aucun livre trouvé dans la catégorie Science."; // Mise à jour du message
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
