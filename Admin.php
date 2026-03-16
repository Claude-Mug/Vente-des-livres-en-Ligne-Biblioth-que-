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
    <title>Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- partie head avec ses attributs -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Panneau d'administration</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Basculer la navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="bi bi-person nav-link active" aria-current="page" href="enregistrer_admin.php">Ajouter Admin</a>
                    </li>
                </li>

                <li class="nav-item ms-5">
                    <a class="nav-link" href="#">Profil</a>
                </li>

                <li class="nav-item dropdown ms-5 ">
                    <a class="nav-link dropdown-toggle bi bi-gear" href="#" id="parametresDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Paramètres
                    </a>
                    <ul class="dropdown-menu bg-danger-subtle" aria-labelledby="parametresDropdown">
                        <li><a class="dropdown-item" href="#">Modifier le mot de passe</a></li>
                        <li><a class="dropdown-item" href="#">Configurer les thèmes</a></li>
                        <li><a class="dropdown-item" href="#">Activer/Désactiver les notifications</a></li>
                        <li><a class="dropdown-item" href="#">Configurer les passerelles de paiement</a></li>
                        <li><a class="dropdown-item" href="#">Afficher l'historique des connexions</a></li>
                        <li><a class="dropdown-item" href="enregistrer_admin.php">Afficher l'historique des connexions</a></li>
                    </ul>
                </li>

                </ul>
            </div>
        </div>
    </nav>

</head>

<body>
    
    <style>
        body{
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
                </div>

            </div>

            <!-- Contenu principal -->
            <div class="col-md-9 bg-danger-subtle">
                <h1>Bienvenue dans le panneau d'administration</h1>

                <div class="row mt-4 ">
                    <!-- Gestion des livres -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Livres</h5>
                                <p class="card-text">Ajouter, modifier, ajouter ou supprimer les livres disponibles sur la plateforme.</p>
                                <a href="#" class="btn btn-primary m-1">Gerer les livres</a>
                                <a href="#" class="btn btn-secondary m-1">Modifier un livre</a>
                                <a href="Livres.php" class="btn btn-danger m-1">Ajouter livre</a>
                            </div>
                        </div>
                    </div>

                    <!-- Gestion des étudiants -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center ">
                                <h5 class="card-title">Étudiants</h5>
                                <p class="card-text">Gérez les étudiants inscrits sur la plateforme.</p>
                                <a href="#" class="btn btn-primary m-1">Ajouter un étudiant</a>
                                <a href="#" class="btn btn-secondary m-1">Modifier un étudiant</a>
                                <a href="#" class="btn btn-danger m-1">Supprimer un étudiant</a>
                            </div>
                        </div>
                    </div>

                    <!-- Gestion des clients -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Clients</h5>
                                <p class="card-text">Gérez les clients et leurs activités sur la plateforme.</p>
                                <a href="#" class="btn btn-primary m-1">Ajouter un client</a>
                                <a href="#" class="btn btn-secondary m-1">Modifier un client</a>
                                <a href="#" class="btn btn-danger m-1">Supprimer un client</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <!-- Revenus et commandes -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Revenus & Commandes</h5>
                                <p class="card-text">Suivez les ventes et analysez les commandes.</p>
                                <button class="btn btn-primary">Voir les détails</button>
                            </div>
                        </div>
                    </div>

                    <!-- Rapports -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Rapports</h5>
                                <p class="card-text">Générez des rapports détaillés sur vos données.</p>
                                <button class="btn btn-primary">Générer des rapports</button>
                            </div>
                        </div>
                    </div>

                    <!-- Support & Notifications -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Support & Notifications</h5>
                                <p class="card-text">Gérez le support et configurez les alertes.</p>
                                <button class="btn btn-primary">Paramétrer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

