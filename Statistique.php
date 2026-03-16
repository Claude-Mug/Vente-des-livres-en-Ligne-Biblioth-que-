<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$db   = 'bibliotheque';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer les données pour les graphiques
$statistiques = [];

// 1. Statistiques des Paiements
$stmt = $pdo->query("
    SELECT DATE(date_paiement) AS date, SUM(idLivre) AS total_paiements
    FROM livres_payer
    GROUP BY DATE(date_paiement)
    ORDER BY date
");
$statistiques['paiements'] = $stmt->fetchAll();

// 2. Statistiques des Nouveaux Comptes Clients
$stmt = $pdo->query("
SELECT COUNT(*) AS nouveaux_clients
FROM client
WHERE idclient IS NOT NULL
");
$statistiques['nouveaux_clients'] = $stmt->fetchAll();

// 3. Statistiques des Connexions
$stmt = $pdo->query("
    SELECT DATE(date_connexion) AS date, COUNT(*) AS total_connexions
    FROM historique_connexions
    GROUP BY DATE(date_connexion)
    ORDER BY date
");
$statistiques['connexions'] = $stmt->fetchAll();

// Convertir les données en format JSON pour Chart.js
$labels_json = json_encode(array_column($statistiques['paiements'], 'date'));
$paiements_json = json_encode(array_column($statistiques['paiements'], 'total_paiements'));
$nouveaux_clients_json = json_encode(array_column($statistiques['nouveaux_clients'], 'nouveaux_clients'));
$connexions_json = json_encode(array_column($statistiques['connexions'], 'total_connexions'));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Statistiques</h1>

        <!-- Graphique des Paiements -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Paiements par Jour</h5>
            </div>
            <div class="card-body">
                <canvas id="paiementsChart"></canvas>
            </div>
        </div>

        <!-- Graphique des Nouveaux Comptes Clients -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Nouveaux Comptes Clients par Jour</h5>
            </div>
            <div class="card-body">
                <canvas id="nouveauxClientsChart"></canvas>
            </div>
        </div>

        <!-- Graphique des Connexions -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Connexions par Jour</h5>
            </div>
            <div class="card-body">
                <canvas id="connexionsChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Données pour les graphiques
        const labels = <?php echo $labels_json; ?>;

        // Graphique des Paiements
        const paiementsData = {
            labels: labels,
            datasets: [{
                label: 'Paiements par Jour',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: <?php echo $paiements_json; ?>,
            }]
        };

        const paiementsConfig = {
            type: 'bar',
            data: paiementsData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const paiementsChart = new Chart(
            document.getElementById('paiementsChart'),
            paiementsConfig
        );

        // Graphique des Nouveaux Comptes Clients
        const nouveauxClientsData = {
            labels: labels,
            datasets: [{
                label: 'Nouveaux Comptes Clients par Jour',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: <?php echo $nouveaux_clients_json; ?>,
            }]
        };

        const nouveauxClientsConfig = {
            type: 'bar',
            data: nouveauxClientsData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const nouveauxClientsChart = new Chart(
            document.getElementById('nouveauxClientsChart'),
            nouveauxClientsConfig
        );

        // Graphique des Connexions
        const connexionsData = {
            labels: labels,
            datasets: [{
                label: 'Connexions par Jour',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: <?php echo $connexions_json; ?>,
            }]
        };

        const connexionsConfig = {
            type: 'bar',
            data: connexionsData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const connexionsChart = new Chart(
            document.getElementById('connexionsChart'),
            connexionsConfig
        );
    </script>
</body>
</html>