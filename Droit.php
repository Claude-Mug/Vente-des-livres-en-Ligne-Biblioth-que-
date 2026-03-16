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
    <title>Livres Entreprise et Droit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center py-1">
        <h1>Livres Entreprise et Droit</h1>
    </header>
    <div class="container mt-4">
        <div class="mb-4">
            <h2>Économie</h2>
            <p>L'économie est l'étude de la production, de la distribution et de la consommation des biens et services. Les ouvrages sur ce sujet examinent les différentes théories économiques et leur impact sur les décisions politiques et commerciales.</p>
        </div>
        <div class="mb-4">
            <h2>Macroéconomie - Microéconomie</h2>
            <p>La macroéconomie se concentre sur l'économie dans son ensemble, analysant des indicateurs tels que le PIB, l'inflation et le chômage. La microéconomie, en revanche, étudie le comportement des individus et des entreprises dans la prise de décisions économiques.</p>
        </div>
        <div class="mb-4">
            <h2>Création d'entreprise</h2>
            <p>La création d'entreprise aborde les étapes et les processus nécessaires pour lancer une nouvelle entreprise. Les livres sur ce sujet traitent des aspects juridiques, financiers et opérationnels de la création d'une entreprise.</p>
        </div>
        <div class="mb-4">
            <h2>Consultant - Freelance - TPE - Etc.</h2>
            <p>Ce domaine explore les différentes formes de travail indépendant et de petites entreprises. Les ouvrages traitent des défis et des opportunités rencontrés par les consultants, freelances et très petites entreprises (TPE) dans leur parcours professionnel.</p>
        </div>
        <div class="mb-4">
            <h2>PME - Commerçant - Exportation</h2>
            <p>Les petites et moyennes entreprises (PME) jouent un rôle crucial dans l'économie. Les livres sur ce sujet abordent les stratégies de croissance, le commerce de détail et les opportunités d'exportation pour les entreprises.</p>
        </div>
        <div class="mb-4">
            <h2>Business Plan</h2>
            <p>Un business plan est un document essentiel pour toute entreprise, décrivant ses objectifs, sa stratégie et son plan financier. Les ouvrages sur ce sujet aident les entrepreneurs à rédiger des business plans efficaces et à attirer des investisseurs.</p>
        </div>
        <div class="mb-4">
            <h2>Stratégie - Direction d'entreprise</h2>
            <p>La stratégie d'entreprise concerne la planification des actions à long terme pour atteindre des objectifs commerciaux. Les livres sur ce sujet explorent les différents modèles de stratégie et les meilleures pratiques pour la direction d'entreprise.</p>
        </div>
        <div class="mb-4">
            <h2>Stratégie militaire et politique</h2>
            <p>Ce domaine examine les parallèles entre la stratégie militaire et la stratégie commerciale. Les ouvrages traitent des concepts de planification, de tactique et de décision dans un contexte économique et politique.</p>
        </div>
        <div class="mb-4">
            <h2>RH et formation</h2>
            <p>Les ressources humaines (RH) jouent un rôle clé dans la gestion du personnel et la formation continue. Les livres sur ce sujet abordent les meilleures pratiques pour le développement des talents et la gestion des performances des employés.</p>
        </div>
        <div class="mb-4">
            <h2>Recrutement</h2>
            <p>Le recrutement est un processus essentiel pour attirer et sélectionner les talents dans une organisation. Les ouvrages traitent des techniques de recrutement, des entretiens et des stratégies pour attirer les meilleurs candidats.</p>
        </div>
        <div class="mb-4">
            <h2>Évaluation</h2>
            <p>L'évaluation des performances et des compétences est cruciale pour le développement organisationnel. Les livres sur ce sujet abordent les méthodes d'évaluation, les indicateurs de performance et l'importance du feedback.</p>
        </div>
        <div class="mb-4">
            <h2>Marketing et vente</h2>
            <p>Le marketing et la vente sont des éléments clés de la réussite d'une entreprise. Les ouvrages sur ce sujet explorent les stratégies de marketing, la gestion des ventes et les techniques de fidélisation des clients.</p>
        </div>
        <div class="mb-4">
            <h2>Management commercial</h2>
            <p>Le management commercial se concentre sur la gestion des équipes de vente et l'optimisation des performances commerciales. Les livres abordent des thèmes tels que la motivation des équipes, la gestion des objectifs et les stratégies de vente.</p>
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
    $stmt->execute(['categorie' => 'Entreprise et Droit']);

    // Affichage des résultats
    if ($stmt->rowCount() > 0) {
        echo "<h2>Livres de la catégorie Droit et entreprise</h2>"; // Mise à jour du titre
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
        echo "Aucun livre trouvé dans la catégorie Droit et Entreprise."; // Mise à jour du message
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