<?php
// config.php
$host = 'localhost';
$db   = 'bibliotheque';
$user = 'root'; // Utilisateur par défaut de XAMPP
$pass = '';     // Mot de passe par défaut de XAMPP
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
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<?php

// Récupérer les 5 derniers clients inscrits
$stmt = $pdo->query("SELECT * FROM client ORDER BY idclient DESC LIMIT 5");
$lastClients = $stmt->fetchAll();

// Récupérer les 5 derniers paiements
$stmt = $pdo->query("SELECT * FROM `livres_payer` ORDER BY date_paiement DESC LIMIT 5");
$lastPayments = $stmt->fetchAll();

// Récupérer les livres en retard
$stmt = $pdo->query("SELECT * FROM emprunts WHERE date_retour < NOW()");
$lateBooks = $stmt->fetchAll();

// Récupérer les stocks critiques (exemple : moins de 5 exemplaires)
$stmt = $pdo->query("SELECT * FROM livres WHERE Prix < 10");
$lowStockBooks = $stmt->fetchAll();

// Récupérer tous les utilisateurs (admins)
$stmt = $pdo->query("SELECT * FROM admin");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Bibliothèque</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Tableau de Bord</h1>

        <!-- Section : Derniers Clients Inscrits -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Derniers Clients Inscrits</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Pays</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lastClients as $client): ?>
                        <tr>
                            <td><?php echo $client['idclient']; ?></td>
                            <td><?php echo $client['nom']; ?></td>
                            <td><?php echo $client['prenom']; ?></td>
                            <td><?php echo $client['email']; ?></td>
                            <td><?php echo $client['pays']; ?></td>
                            <td><?php echo $client['ville']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section : Derniers Paiements -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Derniers Paiements</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client ID</th>
                            <th>Livre ID</th>
                            <th>Date de Paiement</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lastPayments as $payment): ?>
                        <tr>
                            <td><?php echo $payment['id']; ?></td>
                            <td><?php echo $payment['idClient']; ?></td>
                            <td><?php echo $payment['idLivre']; ?></td>
                            <td><?php echo $payment['date_paiement']; ?></td>
                            <td><?php echo $payment['statut']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section : Alertes et Notifications -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Alertes et Notifications</h5>
            </div>
            <div class="card-body">
                <h6>Livres en Retard</h6>
                <ul>
                    <?php foreach ($lateBooks as $book): ?>
                    <li>
                        Livre ID <?php echo $book['idLivre']; ?> - 
                        Client ID <?php echo $book['idClient']; ?> - 
                        Retard depuis <?php echo $book['date_retour']; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <h6 class="mt-3">Stocks Critiques</h6>
                <ul>
                    <?php foreach ($lowStockBooks as $book): ?>
                    <li>
                        Livre ID <?php echo $book['IdLivre']; ?> - 
                        <?php echo $book['Titre']; ?> (Quantité critique)
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Section : Gestion des Utilisateurs -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Gestion des Administrateurs</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead >
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prenon</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['idAdmin']; ?></td>
                            <td><?php echo $user['Nom']; ?></td>
                            <td><?php echo $user['Prenom']; ?></td>
                            <td><?php echo $user['Email']; ?></td>
                            <td>
                                <a href="ModAdmin.php?id=<?php echo $user['idAdmin']; ?>" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="SupAdmin.php?id=<?php echo $user['idAdmin']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="add_user.php" class="btn btn-primary">Ajouter un Utilisateur</a>
            </div>
        </div>
    </div>
</body>
</html>