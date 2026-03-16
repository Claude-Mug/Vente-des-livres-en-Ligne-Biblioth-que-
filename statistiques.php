<?php
session_start();


// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les statistiques
$totalClients = $conn->query("SELECT COUNT(*) AS total FROM client")->fetch_assoc()['total'];
$totalLivres = $conn->query("SELECT COUNT(*) AS total FROM livres")->fetch_assoc()['total'];
$totalLivreetudiant = $conn->query("SELECT COUNT(*) AS total FROM livreetudiant")->fetch_assoc()['total'];
$totalCommandes = $conn->query("SELECT COUNT(*) AS total FROM commandes")->fetch_assoc()['total'];
$totalEmprunts = $conn->query("SELECT COUNT(*) AS total FROM emprunts")->fetch_assoc()['total'];
$revenusTotaux = $conn->query("SELECT SUM(Prix) AS total FROM livres")->fetch_assoc()['total'];

// Statistiques par catégorie
$categories = $conn->query("SELECT Categorie, COUNT(*) AS total FROM livres GROUP BY Categorie");

// Statistiques par statut des emprunts
$statutsEmprunts = $conn->query("SELECT statut, COUNT(*) AS total FROM emprunts GROUP BY statut");

// Top 5 des livres les plus empruntés
$topLivres = $conn->query("SELECT l.Titre, COUNT(e.id) AS total FROM emprunts e JOIN livres l ON e.idLivre = l.IdLivre GROUP BY e.idLivre ORDER BY total DESC LIMIT 5");

// Top 5 des clients les plus actifs
$topClients = $conn->query("SELECT c.Nom, c.Prenom, COUNT(e.id) AS total FROM emprunts e JOIN client c ON e.idClient = c.IdClient GROUP BY e.idClient ORDER BY total DESC LIMIT 5");

// Livres oubliés par les étudiants (non retournés après la date de retour)
$livresOublies = $conn->query("SELECT l.Titre, c.Nom, c.Prenom, e.date_retour FROM emprunts e JOIN livres l ON e.idLivre = l.IdLivre JOIN client c ON e.idClient = c.IdClient WHERE e.date_retour < NOW() AND e.statut = 'accepte'");

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Statistiques Générales</title>
    <style>
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-4 text-center">Statistiques Générales</h1>

    <!-- Statistiques de base -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Clients</h5>
                    <p class="card-text"><?php echo $totalClients; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Livres</h5>
                    <p class="card-text"><?php echo $totalLivres; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Livres etudiant</h5>
                    <p class="card-text"><?php echo $totalLivreetudiant; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Commandes</h5>
                    <p class="card-text"><?php echo $totalCommandes; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Emprunts</h5>
                    <p class="card-text"><?php echo $totalEmprunts; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenus Totaux -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Revenus Totaux</h5>
                    <p class="card-text"><?php echo $revenusTotaux; ?> €</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques par Catégorie -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Livres par Catégorie</h5>
                    <ul class="list-group">
                        <?php while ($categorie = $categories->fetch_assoc()): ?>
                            <li class="list-group-item">
                                <?php echo htmlspecialchars($categorie['Categorie']); ?>
                                <span class="badge badge-primary"><?php echo htmlspecialchars($categorie['total']); ?></span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Statistiques par Statut des Emprunts -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statut des Emprunts</h5>
                    <ul class="list-group">
                        <?php while ($statut = $statutsEmprunts->fetch_assoc()): ?>
                            <li class="list-group-item">
                                <?php echo htmlspecialchars($statut['statut']); ?>
                                <span class="badge badge-secondary"><?php echo htmlspecialchars($statut['total']); ?></span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Top 5 des Livres les Plus Empruntés -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top 5 des Livres les Plus Empruntés</h5>
                    <ul class="list-group">
                        <?php while ($livre = $topLivres->fetch_assoc()): ?>
                            <li class="list-group-item">
                                <?php echo htmlspecialchars($livre['Titre']); ?>
                                <span class="badge badge-success"><?php echo htmlspecialchars($livre['total']); ?> emprunts</span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Top 5 des Clients les Plus Actifs -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top 5 des Clients les Plus Actifs</h5>
                    <ul class="list-group">
                        <?php while ($client = $topClients->fetch_assoc()): ?>
                            <li class="list-group-item">
                                <?php echo htmlspecialchars($client['Prenom'] . ' ' . htmlspecialchars($client['Nom'])); ?>
                                <span class="badge badge-warning"><?php echo htmlspecialchars($client['total']); ?> emprunts</span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des Livres Oubliés par les Étudiants -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Livres Oubliés par les Étudiants</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titre du Livre</th>
                                <th>Nom de l'Étudiant</th>
                                <th>Date de Retour Prévue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($livre = $livresOublies->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($livre['Titre']); ?></td>
                                    <td><?php echo htmlspecialchars($livre['Prenom'] . ' ' . htmlspecialchars($livre['Nom'])); ?></td>
                                    <td><?php echo htmlspecialchars($livre['date_retour']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>