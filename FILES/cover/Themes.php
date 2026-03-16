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

// Récupérer le thème actuel de l'administrateur
$theme_actuel = 'clair'; // Thème par défaut
if (isset($_SESSION['idAdmin'])) {
    $stmt = $pdo->prepare("SELECT theme FROM preferences_admin WHERE idAdmin = ?");
    $stmt->execute([$_SESSION['idAdmin']]);
    $preference = $stmt->fetch();
    $theme_actuel = $preference['theme'] ?? 'clair';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.theme-clair {
            background-color: #ffffff;
            color: #000000;
        }
        body.theme-sombre {
            background-color: #121212;
            color: #ffffff;
        }
    </style>
</head>
<body class="theme-<?php echo $theme_actuel; ?>">
    <!-- Contenu de la page -->
</body>
</html>