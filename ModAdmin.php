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

// Récupérer l'ID de l'administrateur à modifier
$idAdmin = $_GET['id'] ?? null;

if (!$idAdmin) {
    die("ID de l'administrateur non fourni.");
}

// Récupérer les informations de l'administrateur
$stmt = $pdo->prepare("SELECT * FROM admin WHERE idAdmin = ?");
$stmt->execute([$idAdmin]);
$admin = $stmt->fetch();

if (!$admin) {
    die("Administrateur non trouvé.");
}

// Traitement de la mise à jour du profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    // Mettre à jour les informations du profil
    $stmt = $pdo->prepare("UPDATE admin SET Nom = ?, Prenom = ?, Email = ? WHERE idAdmin = ?");
    $stmt->execute([$nom, $prenom, $email, $idAdmin]);

    // Rafraîchir les informations de l'administrateur
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE idAdmin = ?");
    $stmt->execute([$idAdmin]);
    $admin = $stmt->fetch();

    $successMessage = "Profil mis à jour avec succès !";
}

// Traitement du changement de mot de passe
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $ancienMotDePasse = $_POST['ancien_mot_de_passe'];
    $nouveauMotDePasse = $_POST['nouveau_mot_de_passe'];
    $confirmerMotDePasse = $_POST['confirmer_mot_de_passe'];

    // Vérifier l'ancien mot de passe
    if (password_verify($ancienMotDePasse, $admin['MotDePasse'])) {
        if ($nouveauMotDePasse === $confirmerMotDePasse) {
            // Hasher le nouveau mot de passe
            $nouveauMotDePasseHash = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);

            // Mettre à jour le mot de passe
            $stmt = $pdo->prepare("UPDATE admin SET MotDePasse = ? WHERE idAdmin = ?");
            $stmt->execute([$nouveauMotDePasseHash, $idAdmin]);

            $successMessagePassword = "Mot de passe changé avec succès !";
        } else {
            $errorMessagePassword = "Les nouveaux mots de passe ne correspondent pas.";
        }
    } else {
        $errorMessagePassword = "Ancien mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Administrateur</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Modifier Administrateur</h1>

        <!-- Affichage des messages de succès ou d'erreur -->
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <?php if (isset($errorMessagePassword)): ?>
            <div class="alert alert-danger"><?php echo $errorMessagePassword; ?></div>
        <?php endif; ?>

        <?php if (isset($successMessagePassword)): ?>
            <div class="alert alert-success"><?php echo $successMessagePassword; ?></div>
        <?php endif; ?>

        <!-- Section : Informations du Profil -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Informations du Profil</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $admin['Nom']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $admin['Prenom']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin['Email']; ?>" required>
                    </div>
                    <button type="submit" name="update_profile" class="btn btn-primary">Mettre à Jour</button>
                </form>
            </div>
        </div>

        <!-- Section : Changer le Mot de Passe -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Changer le Mot de Passe</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="ancien_mot_de_passe">Ancien Mot de Passe</label>
                        <input type="password" class="form-control" id="ancien_mot_de_passe" name="ancien_mot_de_passe" required>
                    </div>
                    <div class="form-group">
                        <label for="nouveau_mot_de_passe">Nouveau Mot de Passe</label>
                        <input type="password" class="form-control" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmer_mot_de_passe">Confirmer le Nouveau Mot de Passe</label>
                        <input type="password" class="form-control" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" required>
                    </div>
                    <button type="submit" name="change_password" class="btn btn-primary">Changer le Mot de Passe</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>