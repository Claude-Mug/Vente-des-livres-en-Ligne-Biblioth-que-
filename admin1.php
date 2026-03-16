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
    <title>Panneau d'Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Panneau d'administration</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Basculer la navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="bi bi-person nav-link" href="enregistrer_admin.php" target="mainFrame">Ajouter Admin</a>
                    </li>
                    <li class="nav-item ms-5">
                        <a class="nav-link bi bi-preson" href="profil.php" target="mainFrame">Profil</a>
                    </li>
                    <li class="nav-item ms-5">
                        <a class="nav-link bi bi-preson" href="Index.php">Accueil</a>
                    </li>
                    <div class="container w-auto mt-1">
        <form class="d-flex" onsubmit="return handleSearch(event)">
            <input class="form-control me-2" type="search" name="query" placeholder="Rechercher" aria-label="Search" required>
            <button class="btn btn-outline-primary btn-sm" type="submit">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </form>
    </div>

    <script>
        function handleSearch(event) {
            event.preventDefault(); // Empêche l'envoi normal du formulaire
            const query = document.querySelector('input[name="query"]').value;
            const url = 'recherche2.php?query=' + encodeURIComponent(query); // Crée l'URL
            window.location.href = url; // Redirige vers la page de résultats
        }
    </script>
                    <li class="nav-item dropdown ms-5">
                        <a class="bi bi-gear nav-link dropdown-toggle" href="#" id="parametresDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Paramètres
                        </a>
                        <ul class="dropdown-menu bg-danger-subtle" aria-labelledby="parametresDropdown">
                            <li><a class="dropdown-item" href="ModAdmin0.php" target="mainFrame">Modifier le mot de passe</a></li>
                            <li><a class="dropdown-item" href="Themes.php" target="mainFrame">Configurer les thèmes</a></li>
                            <li><a class="dropdown-item" href="notifications.php" target="mainFrame">Activer/Désactiver les notifications</a></li>
                            <li><a class="dropdown-item" href="Statistique.php" target="mainFrame">Statistiques de paiement</a></li>
                            <li><a class="dropdown-item" href="historique_con.php" target="mainFrame">Afficher l'historique des connexions</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</head>

<body>
    <style>
        body {
            padding-top: 65px; /* Espace pour la barre de navigation */
            margin-right: auto;
        }

        .sidebar {
            height: calc(100vh - 65px); /* Hauteur de la barre latérale */
            position: fixed;
            top: 70px; /* Ajustez selon la hauteur de l'en-tête */
            bottom: 0;
            width: 19%;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 20%;
            padding-top: 10px; /* Ajustez selon la hauteur de l'en-tête */
            height: calc(100vh - 65px); /* Hauteur ajustée */
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <!-- Barre latérale -->
            <div class="sidebar bg-info-subtle m-1">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active" onclick="loadContent('tableau.php')">Tableau de bord</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadContent('statistiques.php')">Statistiques générales</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadContent('revenus.php')">Revenus et Analyses</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadContent('notifications.php')">Notifications globales</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="loadContent('support.php')">Support & Assistance</a>
                    <a href="#" class="list-group-item list-group-item-action bg-danger-subtle" onclick="loadContent('admin_paiements.php')">Livres commander</a>
                    <a href="#" class="list-group-item list-group-item-action bg-success-subtle" onclick="loadContent('Admin-emprunter.php')">Livres Emprunter</a>


                    <div class="mt-3">
                        <h4>Livres payant</h4>
                        <div class="d-flex flex-column">
                            <a href="Glivres.php" target="mainFrame" class="btn btn-primary mb-2">Gerer les livres</a>
                            <a href="Glivres.php" target="mainFrame" class="btn btn-secondary mb-2">Modifier un livre</a>
                            <a href="Glivres.php" target="mainFrame" class="btn btn-danger">Supprimer un livre</a>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h4>Livres Etudiants</h4>
                        <div class="d-flex flex-column">
                            <a href="GEtudiant.php" target="mainFrame" class="btn btn-info mb-2">Gérer livres étudiants</a>
                            <a href="Etudiant.php" target="mainFrame" class="btn btn-warning mb-2">Modifier livre étudiant</a>
                            <a href="supprimer_etudiant.php" target="mainFrame" class="btn btn-dark">Supprimer livre étudiant</a>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h4>Clients</h4>
                        <div class="d-flex flex-column">
                            <a href="GClients.php" target="mainFrame" class="btn btn-success mb-2">Gérer les clients</a>
                            <a href="AjouterClient.php" target="mainFrame" class="btn btn-primary mb-2">Ajouter un client</a>
                            <a href="SupClients.php" target="mainFrame" class="btn btn-danger">Supprimer un client</a>
                            <li class="text-invisible">Merci</li>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contenu principal -->
            <div class="col-md-9 main-content">
                <h2 class="text-center text-info">Bienvenue dans le panneau d'administration</h2>
                <iframe name="mainFrame" id="mainFrame" style="width: 100%; height: calc(100vh - 130px); border: none;"></iframe>   
            </div> 
        </div>
    </div>
    
    <script>
        function loadContent(content) {
            const mainFrame = document.getElementById("mainFrame");
            mainFrame.src = content;
        }
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>