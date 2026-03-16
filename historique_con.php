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

// Fonction pour enregistrer une connexion
function enregistrerConnexion($pdo, $id_utilisateur, $type_utilisateur) {
    $adresse_ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $stmt = $pdo->prepare("INSERT INTO historique_connexions (id_utilisateur, type_utilisateur, adresse_ip, user_agent) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id_utilisateur, $type_utilisateur, $adresse_ip, $user_agent]);
}

// Exemple d'enregistrement de connexion (à adapter selon votre logique de connexion)
if (isset($_SESSION['idClient'])) {
    enregistrerConnexion($pdo, $_SESSION['idClient'], 'client');
} elseif (isset($_SESSION['idAdmin'])) {
    enregistrerConnexion($pdo, $_SESSION['idAdmin'], 'admin');
} else {
    enregistrerConnexion($pdo, 0, 'autre'); // Pour les utilisateurs non identifiés
}

// Récupérer l'historique des connexions avec les noms des utilisateurs
$stmt = $pdo->query("
    SELECT h.*, 
           CASE 
               WHEN h.type_utilisateur = 'client' THEN CONCAT(c.nom, ' ', c.prenom)
               WHEN h.type_utilisateur = 'admin' THEN CONCAT(a.nom, ' ', a.prenom)
               ELSE 'Visiteur'
           END AS nom_utilisateur
    FROM historique_connexions h
    LEFT JOIN client c ON h.id_utilisateur = c.idclient AND h.type_utilisateur = 'client'
    LEFT JOIN admin a ON h.id_utilisateur = a.idAdmin AND h.type_utilisateur = 'admin'
    ORDER BY h.date_connexion DESC
");
$historique = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Connexions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Historique des Connexions</h1>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Type</th>
                    <th>Date et Heure</th>
                    <th>Adresse IP</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historique as $connexion): ?>
                <tr>
                    <td><?php echo $connexion['id']; ?></td>
                    <td><?php echo $connexion['nom_utilisateur']; ?></td>
                    <td><?php echo $connexion['type_utilisateur']; ?></td>
                    <td><?php echo $connexion['date_connexion']; ?></td>
                    <td><?php echo $connexion['adresse_ip']; ?></td>
                    <td><?php echo $connexion['user_agent']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>