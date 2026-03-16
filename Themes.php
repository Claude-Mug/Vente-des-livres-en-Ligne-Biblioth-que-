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

<?php
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

// Récupérer l'ID de l'administrateur
//$idAdmin = $_SESSION['idAdmin'];

// Récupérer le thème actuel de l'administrateur
//$stmt = $pdo->prepare("SELECT theme FROM preferences_admin WHERE idAdmin = ?");
//$stmt->execute([$idAdmin]);
//$preference = $stmt->fetch();

$theme_actuel = $preference['theme'] ?? 'clair'; // Thème par défaut

// Traitement du changement de thème
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changer_theme'])) {
    $nouveau_theme = $_POST['theme'];

    // Mettre à jour ou insérer la préférence de thème
    $stmt = $pdo->prepare("REPLACE INTO preferences_admin (idAdmin, theme) VALUES (?, ?)");
    $stmt->execute([$idAdmin, $nouveau_theme]);

    // Rediriger pour éviter la soumission multiple du formulaire
    header("Location: configurer_theme_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Configurer le Thème (Admin)</title>
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
    <div class="container">
        <h1 class="mt-4">Configurer le Thème (Admin)</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label for="theme">Choisissez un thème :</label>
                <select class="form-control" id="theme" name="theme">
                    <option value="clair" <?php echo ($theme_actuel === 'clair') ? 'selected' : ''; ?>>Thème Clair</option>
                    <option value="sombre" <?php echo ($theme_actuel === 'sombre') ? 'selected' : ''; ?>>Thème Sombre</option>
                </select>
            </div>
            <button type="submit" name="changer_theme" class="btn btn-primary">Appliquer le Thème</button>
        </form>
    </div>
</body>
</html>