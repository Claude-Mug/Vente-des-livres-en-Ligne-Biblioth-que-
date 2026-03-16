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

// Récupérer les statistiques
$totalLivres = $conn->query("SELECT COUNT(*) AS total FROM livres")->fetch_assoc()['total'];
$totalLivresEtudiant = $conn->query("SELECT COUNT(*) AS total FROM livreetudiant")->fetch_assoc()['total'];
$totalEmprunts = $conn->query("SELECT COUNT(*) AS total FROM emprunts")->fetch_assoc()['total'];
$totalCommandes = $conn->query("SELECT COUNT(*) AS total FROM commandes")->fetch_assoc()['total'];
$totalClients = $conn->query("SELECT COUNT(*) AS total FROM client")->fetch_assoc()['total'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques Générales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Statistiques Générales</h1>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total des Livres</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalLivres; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total des Livres Étudiants</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalLivresEtudiant; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total des Emprunts</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalEmprunts; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total des Commandes</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalCommandes; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Total des Clients</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalClients; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>