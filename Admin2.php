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
                        <a class="bi bi-person nav-link" href="#">Ajouter Admin</a>
                    </li>
                    <li class="nav-item ms-5">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</head>

<body>
    <style>
        body {
            padding-top: 65px;
        }
    </style>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Barre latérale -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Tableau de bord</a>
                    <a href="#" class="list-group-item list-group-item-action">Statistiques générales</a>
                    <a href="#" class="list-group-item list-group-item-action">Revenus et Analyses</a>
                    <a href="#" class="list-group-item list-group-item-action">Gérer les promotions</a>
                    <a href="#" class="list-group-item list-group-item-action">Notifications globales</a>
                    <a href="#" class="list-group-item list-group-item-action">Support & Assistance</a>
                    <a href="#" class="list-group-item list-group-item-action">Étudiants</a>
                    <a href="#" class="list-group-item list-group-item-action">Livres</a>
                    <a href="#" class="list-group-item list-group-item-action">Clients</a>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-9 bg-danger-subtle" id="mainContent">
                <h1>Bienvenue dans le panneau d'administration</h1>
                <p>Veuillez sélectionner une option dans la barre latérale.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>