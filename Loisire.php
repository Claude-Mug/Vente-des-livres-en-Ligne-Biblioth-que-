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
    <title>Livres Art et Loisir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center py-1">
        <h1>Livres Art et Loisir</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Arts Créatifs</h2>
            <p>Les arts créatifs englobent diverses pratiques telles que la peinture, le dessin, la sculpture et le collage. Ces activités permettent aux individus d'exprimer leur créativité tout en développant des compétences techniques. Les livres sur ce sujet offrent des tutoriels, des techniques et des inspirations pour les artistes amateurs.</p>
        </div>
        <div class="mb-4">
            <h2>Artisanat</h2>
            <p>L'artisanat se concentre sur la création d'objets faits à la main, allant de la poterie à la couture en passant par la bijouterie. Les ouvrages sur l'artisanat proposent des guides pratiques et des projets DIY (Do It Yourself) pour encourager les loisirs manuels et la création personnelle.</p>
        </div>
        <div class="mb-4">
            <h2>Photographie de Loisirs</h2>
            <p>La photographie est un loisir populaire qui permet de capturer des moments et des paysages. Les livres sur la photographie de loisirs traitent des techniques de prise de vue, de composition et d'édition, aidant les passionnés à améliorer leurs compétences.</p>
        </div>
        <div class="mb-4">
            <h2>Musique et Arts Performatifs</h2>
            <p>La musique et les arts performatifs, tels que la danse et le théâtre, sont des formes d'expression artistique qui engagent le corps et l'esprit. Les ouvrages sur ce sujet explorent la théorie musicale, les techniques de performance et les différents genres artistiques.</p>
        </div>
        <div class="mb-4">
            <h2>Loisirs et Art Thérapeutique</h2>
            <p>L'art thérapie utilise des pratiques artistiques comme moyen d'expression et de guérison. Les livres sur l'art thérapeutique traitent des bénéfices psychologiques de l'art et des techniques utilisées pour favoriser le bien-être à travers la créativité.</p>
        </div>
        <div class="mb-4">
            <h2>Arts Visuels et Culture Populaire</h2>
            <p>Les arts visuels, y compris la peinture, la sculpture et le graphisme, jouent un rôle important dans la culture populaire. Les ouvrages sur ce sujet examinent l'impact des arts visuels sur la société et leur évolution au fil du temps.</p>
        </div>
        <div class="mb-4">
            <h2>Écriture Créative</h2>
            <p>Les loisirs d'écriture créative encouragent l'expression personnelle à travers des récits, des poèmes et des essais. Les livres sur l'écriture créative offrent des conseils pratiques, des exercices d'écriture et des stratégies pour développer sa voix littéraire.</p>
        </div>
        <div class="mb-4">
            <h2>Jardinage Artistique</h2>
            <p>Le jardinage artistique combine l'amour de la nature avec la créativité. Les ouvrages sur ce sujet explorent les techniques de conception de jardins, l'aménagement paysager et l'utilisation des plantes comme éléments artistiques.</p>
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
    $stmt->execute(['categorie' => 'Arts & Loisir']);

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