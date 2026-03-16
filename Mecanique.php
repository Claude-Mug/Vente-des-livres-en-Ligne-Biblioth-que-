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
    <title>Livres Mécanique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center py-1">
        <h1>Livres Mécanique</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Mécanique Classique</h2>
            <p>La mécanique classique étudie les mouvements des corps et les forces qui agissent sur eux. Elle repose sur les lois de Newton et englobe des concepts tels que la dynamique, la statique et la cinématique, fournissant des bases solides pour la compréhension des phénomènes physiques quotidiens.</p>
        </div>
        <div class="mb-4">
            <h2>Mécanique des Fluides</h2>
            <p>La mécanique des fluides se concentre sur le comportement des fluides en repos et en mouvement. Cette discipline est cruciale pour des applications dans l'ingénierie, comme la conception de systèmes hydrauliques, l'aérodynamique et l'hydrodynamique, ainsi que dans les études environnementales.</p>
        </div>
        <div class="mb-4">
            <h2>Mécanique des Solides</h2>
            <p>La mécanique des solides traite du comportement des matériaux solides sous l'effet de forces. Les ouvrages sur ce sujet abordent des thèmes tels que la résistance des matériaux, la déformation et les contraintes, essentiels pour la conception et l'analyse des structures en ingénierie.</p>
        </div>
        <div class="mb-4">
            <h2>Dynamique</h2>
            <p>La dynamique étudie les forces et leur impact sur le mouvement des objets. Elle est fondamentale pour l'analyse des systèmes mécaniques en mouvement, incluant des concepts comme l'énergie cinétique, le travail et la conservation de l'énergie.</p>
        </div>
        <div class="mb-4">
            <h2>Statique</h2>
            <p>La statique se concentre sur les forces agissant sur des objets au repos. Elle est essentielle pour comprendre l'équilibre des structures, que ce soit dans le bâtiment, le pont ou toute autre construction, et est souvent utilisée dans le design architectural.</p>
        </div>
        <div class="mb-4">
            <h2>Mécanique Quantique</h2>
            <p>La mécanique quantique explore les comportements des particules à l'échelle atomique et subatomique. Ce domaine révolutionne notre compréhension de la matière et de l'énergie, avec des implications profondes pour la physique moderne et la technologie, comme les ordinateurs quantiques.</p>
        </div>
        <div class="mb-4">
            <h2>Mécanique des Vibrations</h2>
            <p>La mécanique des vibrations traite des oscillations des systèmes mécaniques. Les ouvrages sur ce sujet abordent les concepts de fréquence, d'amplitude et de résonance, et sont applicables dans des domaines variés allant de l'ingénierie acoustique à la conception de machines.</p>
        </div>
        <div class="mb-4">
            <h2>Thermodynamique</h2>
            <p>Bien que souvent considérée comme une branche distincte, la thermodynamique est étroitement liée à la mécanique. Elle étudie les relations entre chaleur, travail et énergie, jouant un rôle crucial dans le fonctionnement des moteurs et des systèmes énergétiques.</p>
        </div>
        <div class="mb-4">
            <h2>Ingénierie Mécanique</h2>
            <p>L'ingénierie mécanique applique les principes de la mécanique à la conception et à la fabrication de machines et de systèmes. Les livres sur ce sujet couvrent divers aspects, de la conception assistée par ordinateur (CAO) à la fabrication additive, et sont essentiels pour les futurs ingénieurs.</p>
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
    $stmt->execute(['categorie' => 'Mecanique']);

    // Affichage des résultats
    if ($stmt->rowCount() > 0) {
        echo "<h2>Livres de la catégorie Mecanique</h2>"; // Mise à jour du titre
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