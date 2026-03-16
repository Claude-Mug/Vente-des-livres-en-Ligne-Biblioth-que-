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

// Récupérer l'ID de l'administrateur à supprimer
$idAdmin = $_GET['id'] ?? null;

if (!$idAdmin) {
    die("ID de l'administrateur non fourni.");
}

// Vérifier si l'administrateur existe
$stmt = $pdo->prepare("SELECT * FROM admin WHERE idAdmin = ?");
$stmt->execute([$idAdmin]);
$admin = $stmt->fetch();

if (!$admin) {
    die("Administrateur non trouvé.");
}

// Supprimer l'administrateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $stmt = $pdo->prepare("DELETE FROM admin WHERE idAdmin = ?");
    $stmt->execute([$idAdmin]);

    // Rediriger vers la page de profil après la suppression
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer Administrateur</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Supprimer Administrateur</h1>

        <p>Êtes-vous sûr de vouloir supprimer l'administrateur <strong><?php echo $admin['Nom'] . ' ' . $admin['Prenom']; ?></strong> ?</p>

        <form method="POST" action="">
            <button type="submit" name="confirm_delete" class="btn btn-danger">Confirmer la suppression</button>
            <a href="profile.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>