<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur
$password = ""; // Remplacez par votre mot de passe
$dbname = "bibliotheque"; // Nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérifier si la requête de recherche est définie
if (isset($_GET['query'])) {
    $query = $conn->real_escape_string($_GET['query']);
    
    // Requêtes de recherche pour chaque table
    $sqlClients = "SELECT * FROM client WHERE nom LIKE '%$query%' OR prenom LIKE '%$query%'";
    $sqlLivres = "SELECT * FROM livres WHERE titre LIKE '%$query%' OR auteur LIKE '%$query%'";
    $sqlCategories = "SELECT * FROM categorie WHERE name LIKE '%$query%'";
    $sqlCommandes = "SELECT * FROM commandes WHERE idclient LIKE '%$query%' OR date_commande LIKE '%$query%'";
    $sqlEmprunts = "SELECT * FROM emprunts WHERE idclient LIKE '%$query%' OR idlivre LIKE '%$query%'";
    $sqlHistorique = "SELECT * FROM historique_connexions WHERE type_utilisateur LIKE '%$query%' OR id LIKE '%$query%'";
    $sqlNotifications = "SELECT * FROM notifications WHERE message LIKE '%$query%'";
    $sqlLivresEtudiant = "SELECT * FROM livreetudiant WHERE titre LIKE '%$query%'";
    $sqlLivresPayer = "SELECT * FROM livres_payer WHERE idclient LIKE '%$query%' OR idlivre LIKE '%$query%'";
    $sqlInformatique = "SELECT * FROM informatique WHERE IdInfo LIKE '%$query%'";
    $sqlAdmin = "SELECT * FROM admin WHERE nom LIKE '%$query%' OR prenom LIKE '%$query%'";
    $sqlEmpruntsLivres = "SELECT * FROM emprunts WHERE idlivre LIKE '%$query%' OR idclient LIKE '%$query%'";

    // Exécuter les requêtes
    $resultsClients = $conn->query($sqlClients);
    $resultsLivres = $conn->query($sqlLivres);
    $resultsCategories = $conn->query($sqlCategories);
    $resultsCommandes = $conn->query($sqlCommandes);
    $resultsEmprunts = $conn->query($sqlEmprunts);
    $resultsHistorique = $conn->query($sqlHistorique);
    $resultsNotifications = $conn->query($sqlNotifications);
    $resultsLivresEtudiant = $conn->query($sqlLivresEtudiant);
    $resultsLivresPayer = $conn->query($sqlLivresPayer);
    $resultsInformatique = $conn->query($sqlInformatique);
    $resultsAdmin = $conn->query($sqlAdmin);
    $resultsEmpruntsLivres = $conn->query($sqlEmpruntsLivres);

    // Vérifier les résultats et rediriger vers la page appropriée
    if ($resultsClients->num_rows > 0) {
        header("Location: Client.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsLivres->num_rows > 0) {
        header("Location: Livres.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsCategories->num_rows > 0) {
        header("Location: categories.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsCommandes->num_rows > 0) {
        header("Location: commandes.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsEmprunts->num_rows > 0) {
        header("Location: emprunts.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsHistorique->num_rows > 0) {
        header("Location: historique.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsNotifications->num_rows > 0) {
        header("Location: notifications.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsLivresEtudiant->num_rows > 0) {
        header("Location: livreetudiant.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsLivresPayer->num_rows > 0) {
        header("Location: livrespayer.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsInformatique->num_rows > 0) {
        header("Location: informatique.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsAdmin->num_rows > 0) {
        header("Location: admin.php?query=" . urlencode($query));
        exit();
    } elseif ($resultsEmpruntsLivres->num_rows > 0) {
        header("Location: empruntslivres.php?query=" . urlencode($query));
        exit();
    } else {
        // Si aucun résultat n'est trouvé, rediriger vers une page de "pas de résultats"
        header("Location: no_results.php?query=" . urlencode($query));
        exit();
    }
}

$conn->close();
?>