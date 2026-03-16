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
    <title>Livres Informatique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
        }
        .left-column, .right-column {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div><header class="bg-dark text-white text-center py-1">
        <h1>Livres Informatique</h1>
    </div>
    <div class="m-2">
        <h1 class="text-center bg-primary">Introduction Generale</h1>
        <p>L'informatique est un domaine vaste et dynamique qui englobe l'étude, la conception et l'application des systèmes informatiques et des logiciels. Elle se divise en plusieurs sous-domaines, tels que la programmation, la cybersécurité, l'intelligence artificielle, le développement web, et le data science. Chacun de ces sous-domaines joue un rôle crucial dans la transformation numérique de notre société. Par exemple, la programmation permet de créer des applications et des logiciels qui répondent à des besoins spécifiques, tandis que la cybersécurité se concentre sur la protection des données et des systèmes contre les menaces. L'intelligence artificielle, quant à elle, cherche à simuler des processus cognitifs humains, ouvrant la voie à des innovations comme les assistants virtuels. En somme, l'informatique, avec ses multiples facettes, influence profondément notre quotidien et façonne l'avenir technologique</p>
        <div class="mt-4">
            <h2>Qu'est-ce que l'Informatique ?</h2>
            <p>
                L'informatique est la science du traitement automatique de l'information. Elle englobe un large éventail de disciplines, allant de la programmation et du développement de logiciels à la gestion des bases de données, en passant par le réseau et la cybersécurité. L'informatique est devenue essentielle dans notre quotidien, touchant presque tous les aspects de nos vies, des communications aux transactions financières, en passant par le divertissement et l'éducation.
            </p>
        </div>
    </header>
    
    <div class="container mt-4">
        <div class="left-column">
            <div class="mb-4">
                <h2>Développement web</h2>
                <p>Ce domaine couvre les technologies et langages utilisés pour créer des sites web interactifs et fonctionnels.</p>
            </div>
            <div class="mb-4">
                <h2>Développement d'applications</h2>
                <p>Le développement d'applications inclut la création de logiciels pour ordinateurs et appareils mobiles.</p>
            </div>
            <div class="mb-4">
                <h2>Outils de développement</h2>
                <p>Les outils de développement facilitent la programmation, le débogage et la gestion des projets de logiciels.</p>
            </div>
            <div class="mb-4">
                <h2>Informatique d'entreprise</h2>
                <p>Cela concerne l'utilisation des technologies de l'information pour améliorer l'efficacité des opérations commerciales.</p>
            </div>
            <div class="mb-4">
                <h2>Management des systèmes d'information</h2>
                <p>Ce domaine traite de la gestion des systèmes d'information pour optimiser les processus décisionnels.</p>
            </div>
            <div class="mb-4">
                <h2>Conception et développement web</h2>
                <p>La conception et le développement web impliquent la création visuelle et technique de sites internet.</p>
            </div>
            <div class="mb-4">
                <h2>Référencement de sites</h2>
                <p>Le référencement est essentiel pour augmenter la visibilité des sites web sur les moteurs de recherche.</p>
            </div>
        </div>
        <div class="right-column">
            <div class="mb-4">
                <h2>Systèmes d'exploitation</h2>
                <p>Les systèmes d'exploitation comme Windows, UNIX et Linux sont fondamentaux pour le fonctionnement des ordinateurs.</p>
            </div>
            <div class="mb-4">
                <h2>Hardware et matériels</h2>
                <p>Ce domaine couvre les composants physiques des ordinateurs, y compris les processeurs, la mémoire et les cartes mères.</p>
            </div>
            <div class="mb-4">
                <h2>Architecture des ordinateurs</h2>
                <p>L'architecture des ordinateurs traite de la conception et de l'organisation des systèmes informatiques.</p>
            </div>
            <div class="mb-4">
                <h2>Électronique pour l'informatique</h2>
                <p>Ce domaine explore les principes électroniques appliqués aux systèmes informatiques.</p>
            </div>
            <div class="mb-4">
                <h2>Périphériques</h2>
                <p>Les périphériques incluent les dispositifs externes comme les imprimantes, les scanners et les souris.</p>
            </div>
            <div class="mb-4">
                <h2>Électronique</h2>
                <p>Ce domaine couvre les concepts fondamentaux de l'électronique, essentiels pour comprendre le matériel informatique.</p>
            </div>
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
    $stmt->execute(['categorie' => 'Informatique']);

    // Affichage des résultats
    if ($stmt->rowCount() > 0) {
        echo "<h2>Livres de la catégorie Informatique</h2>"; // Mise à jour du titre
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