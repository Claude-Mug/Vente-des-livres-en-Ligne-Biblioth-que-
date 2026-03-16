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

    // Affichage des résultats
    echo "<h2>Résultats de la recherche pour: " . htmlspecialchars($query) . "</h2>";

    // Afficher les résultats des clients
    if ($resultsClients->num_rows > 0) {
        echo "<h3>Clients:</h3>";
        while ($row = $resultsClients->fetch_assoc()) {
            echo "<div>" . htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prenom']) . "</div>";
        }
    } else {
        echo "<h3>Aucun client trouvé.</h3>";
    }

    // Afficher les résultats des livres
    if ($resultsLivres->num_rows > 0) {
        echo "<h3>Livres:</h3>";
        while ($row = $resultsLivres->fetch_assoc()) {
            echo "<div>" . htmlspecialchars($row['Titre']) . " par " . htmlspecialchars($row['Auteur']) . "</div>";
        }
    } else {
        echo "<h3>Aucun livre trouvé.</h3>";
    }

    // Afficher les résultats des catégories
    if ($resultsCategories->num_rows > 0) {
        echo "<h3>Catégories:</h3>";
        while ($row = $resultsCategories->fetch_assoc()) {
            echo "<div>" . htmlspecialchars($row['name']) . "</div>";
        }
    } else {
        echo "<h3>Aucune catégorie trouvée.</h3>";
    }

    // Afficher les résultats des commandes
    if ($resultsCommandes->num_rows > 0) {
        echo "<h3>Commandes:</h3>";
        while ($row = $resultsCommandes->fetch_assoc()) {
            echo "<div>ID Client: " . htmlspecialchars($row['idclient']) . " - Date: " . htmlspecialchars($row['date_commande']) . "</div>";
        }
    } else {
        echo "<h3>Aucune commande trouvée.</h3>";
    }

    // Afficher les résultats des emprunts
    if ($resultsEmprunts->num_rows > 0) {
        echo "<h3>Emprunts:</h3>";
        while ($row = $resultsEmprunts->fetch_assoc()) {
            echo "<div>ID Client: " . htmlspecialchars($row['idclient']) . " - ID Livre: " . htmlspecialchars($row['idlivre']) . "</div>";
        }
    } else {
        echo "<h3>Aucun emprunt trouvé.</h3>";
    }

    // Afficher les résultats de l'historique
    if ($resultsHistorique->num_rows > 0) {
        echo "<h3>Historique des Connexions:</h3>";
        while ($row = $resultsHistorique->fetch_assoc()) {
            echo "<div>Type: " . htmlspecialchars($row['type_utilisateur']) . " - IP: " . htmlspecialchars($row['ip_address']) . "</div>";
        }
    } else {
        echo "<h3>Aucun historique trouvé.</h3>";
    }

    // Afficher les résultats des notifications
    if ($resultsNotifications->num_rows > 0) {
        echo "<h3>Notifications:</h3>";
        while ($row = $resultsNotifications->fetch_assoc()) {
            echo "<div>" . htmlspecialchars($row['message']) . "</div>";
        }
    } else {
        echo "<h3>Aucune notification trouvée.</h3>";
    }

    // Afficher les résultats des livres étudiants
    if ($resultsLivresEtudiant->num_rows > 0) {
        echo "<h3>Livres Étudiants:</h3>";
        while ($row = $resultsLivresEtudiant->fetch_assoc()) {
            echo "<div>" . htmlspecialchars($row['nom_etudiant']) . "</div>";
        }
    } else {
        echo "<h3>Aucun livre étudiant trouvé.</h3>";
    }

    // Afficher les résultats des livres payés
    if ($resultsLivresPayer->num_rows > 0) {
        echo "<h3>Livres Payés:</h3>";
        while ($row = $resultsLivresPayer->fetch_assoc()) {
            echo "<div>ID Client: " . htmlspecialchars($row['idclient']) . " - ID Livre: " . htmlspecialchars($row['idlivre']) . "</div>";
        }
    } else {
        echo "<h3>Aucun livre payé trouvé.</h3>";
    }

    // Afficher les résultats en informatique
    if ($resultsInformatique->num_rows > 0) {
        echo "<h3>Informatique:</h3>";
        while ($row = $resultsInformatique->fetch_assoc()) {
            echo "<div>Description: " . htmlspecialchars($row['description']) . "</div>";
        }
    } else {
        echo "<h3>Aucune information trouvée en informatique.</h3>";
    }

    // Afficher les résultats de l'administration
    if ($resultsAdmin->num_rows > 0) {
        echo "<h3>Administrateurs:</h3>";
        while ($row = $resultsAdmin->fetch_assoc()) {
            echo "<div>" . htmlspecialchars($row['Nom']) . " " . htmlspecialchars($row['Prenom']) . "</div>";
        }
    } else {
        echo "<h3>Aucun administrateur trouvé.</h3>";
    }

    // Afficher les résultats des emprunts de livres
    if ($resultsEmpruntsLivres->num_rows > 0) {
        echo "<h3>Emprunts de Livres:</h3>";
        while ($row = $resultsEmpruntsLivres->fetch_assoc()) {
            echo "<div>ID Client: " . htmlspecialchars($row['idclient']) . " - ID Livre: " . htmlspecialchars($row['idlivre']) . "</div>";
        }
    } else {
        echo "<h3>Aucun emprunt de livre trouvé.</h3>";
    }
}

$conn->close();
?>