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
    <title>Livres Construction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center py-1">
        <h1>Livres Construction</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Architecture</h2>
            <p>L'architecture est l'art et la science de concevoir des bâtiments et des espaces. Les ouvrages sur ce sujet abordent des styles architecturaux, des techniques de conception et des considérations esthétiques, ainsi que la fonctionnalité des espaces construits.</p>
        </div>
        <div class="mb-4">
            <h2>Ingénierie Civile</h2>
            <p>L'ingénierie civile concerne la conception, la construction et l'entretien des infrastructures, telles que les routes, les ponts et les bâtiments. Les livres sur ce domaine traitent des matériaux, des méthodes de construction et des normes de sécurité.</p>
        </div>
        <div class="mb-4">
            <h2>Génie Structurel</h2>
            <p>Le génie structurel se concentre sur la conception et l'analyse des structures pour s'assurer qu'elles peuvent supporter les charges et les forces auxquelles elles sont soumises. Les ouvrages abordent les principes de la mécanique appliqués aux matériaux de construction.</p>
        </div>
        <div class="mb-4">
            <h2>Construction Durable</h2>
            <p>La construction durable vise à minimiser l'impact environnemental des bâtiments. Les livres sur ce sujet traitent des matériaux écologiques, de l'efficacité énergétique et des pratiques de construction respectueuses de l'environnement.</p>
        </div>
        <div class="mb-4">
            <h2>Gestion de Projet de Construction</h2>
            <p>La gestion de projet de construction implique la planification, l'organisation et le contrôle des projets de construction. Les ouvrages abordent des techniques de gestion, des outils de planification et des méthodes d'évaluation des risques.</p>
        </div>
        <div class="mb-4">
            <h2>Techniques de Construction</h2>
            <p>Les techniques de construction englobent les méthodes et les procédés utilisés pour ériger des bâtiments. Les livres sur ce sujet explorent les différentes approches, les outils et les équipements utilisés dans le domaine de la construction.</p>
        </div>
        <div class="mb-4">
            <h2>Matériaux de Construction</h2>
            <p>Les matériaux de construction sont essentiels à la solidité et à la durabilité des structures. Les ouvrages traitent des propriétés des matériaux, de leur utilisation et des innovations dans le domaine des matériaux de construction.</p>
        </div>
        <div class="mb-4">
            <h2>Normes et Réglementations</h2>
            <p>Les normes et réglementations régissent les pratiques de construction pour assurer la sécurité et la qualité des bâtiments. Les livres sur ce sujet abordent les codes du bâtiment, les standards de sécurité et les exigences légales.</p>
        </div>
        <div class="mb-4">
            <h2>Inspection et Maintenance</h2>
            <p>L'inspection et la maintenance des bâtiments sont cruciales pour garantir leur sécurité et leur longévité. Les ouvrages traitent des méthodes d'inspection, des techniques de maintenance préventive et des procédures de réparation.</p>
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
    $stmt->execute(['categorie' => 'Construction']);

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
        echo "Aucun livre trouvé dans la catégorie Construction."; // Mise à jour du message
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