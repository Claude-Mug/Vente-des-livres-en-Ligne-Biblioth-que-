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
    <title>Livres Littérature</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center py-1">
        <h1>Livres Littérature</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Romans - Rentrée littéraire 2024</h2>
            <p>La rentrée littéraire 2024 promet une multitude de romans captivants, avec des récits variés allant de la fiction contemporaine aux œuvres plus traditionnelles. Ces romans explorent des thèmes universels et offrent des perspectives nouvelles sur notre société.</p>
        </div>
        <div class="mb-4">
            <h2>Policier - Thriller</h2>
            <p>Les romans policiers et thrillers sont conçus pour tenir les lecteurs en haleine. Ils combinent mystère, suspense et intrigue, souvent avec des détectives ou des enquêteurs s'attaquant à des crimes complexes, captivant ainsi les amateurs de sensations fortes.</p>
        </div>
        <div class="mb-4">
            <h2>Science Fiction - Fantasy</h2>
            <p>La science-fiction et la fantasy transportent les lecteurs dans des mondes imaginaires, abordant des thèmes futuristes ou fantastiques. Ces genres explorent des questions philosophiques et sociales tout en divertissant avec des éléments d'aventure et d'évasion.</p>
        </div>
        <div class="mb-4">
            <h2>Roman historique</h2>
            <p>Le roman historique plonge les lecteurs dans des époques passées, mêlant faits historiques et fiction. Ces récits offrent une perspective sur des événements marquants et des personnages historiques, tout en rendant l'histoire accessible et engageante.</p>
        </div>
        <div class="mb-4">
            <h2>Humour</h2>
            <p>Les livres humoristiques apportent légèreté et divertissement, souvent en utilisant des situations comiques, des jeux de mots ou des personnages excentriques. Ils sont parfaits pour ceux qui cherchent à se détendre et à rire.</p>
        </div>
        <div class="mb-4">
            <h2>Théâtre</h2>
            <p>Les pièces de théâtre, qu'elles soient classiques ou contemporaines, explorent des thèmes variés à travers le dialogue et la performance. Le théâtre offre une expérience unique, souvent en abordant des questions sociétales et humaines de manière directe et engageante.</p>
        </div>
        <div class="mb-4">
            <h2>Poésie</h2>
            <p>La poésie utilise le langage de manière artistique pour exprimer des émotions, des idées et des réflexions. Elle peut être lyrique, narrative ou expérimentale, et permet une exploration profonde de la condition humaine à travers une forme concise et souvent rythmée.</p>
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
    $stmt->execute(['categorie' => 'Litterature']);

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
            echo "<a href='lire.php?fichier=" . urlencode($fichier) . "' class='btn btn-primary'>Lire </a> ";
            echo "<a href='panier.php?id=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-outline-success'>Ajouter au panier</a> ";
            echo "<a href='emprunter_livre.php?id=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-outline-danger m-1'>Emprunter</a>";
            echo "</div></div></div>";
        }
        echo "</div>";
    } else {
        echo "Aucun livre trouvé dans la catégorie Litterature."; // Mise à jour du message
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