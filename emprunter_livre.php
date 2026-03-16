<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idClient'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$idClient = $_SESSION['idClient'];

// Vérifier si l'ID du livre est passé en paramètre
if (!isset($_GET['id'])) {
    header("Location: index.php"); // Rediriger si l'ID est manquant
    exit();
}

$idLivre = $_GET['id'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le livre est disponible
$livreQuery = "SELECT * FROM livres WHERE IdLivre = ?";
$stmt = $conn->prepare($livreQuery);
$stmt->bind_param("i", $idLivre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Livre non trouvé.");
}

$livre = $result->fetch_assoc();

// Enregistrer l'emprunt dans la base de données avec le statut "en_attente"
$dateEmprunt = date('Y-m-d H:i:s'); // Date actuelle
$dateRetour = date('Y-m-d H:i:s', strtotime('+14 days')); // Date de retour dans 14 jours

$insertQuery = "INSERT INTO emprunts (idClient, idLivre, date_emprunt, date_retour, statut) VALUES (?, ?, ?, ?, 'en_attente')";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("iiss", $idClient, $idLivre, $dateEmprunt, $dateRetour);

if ($stmt->execute()) {
    // Rediriger vers la page mes_emprunts.php après l'enregistrement
    header("Location: mes_emprunts.php");
    exit();
} else {
    $erreur = "Erreur lors de la demande d'emprunt : " . $stmt->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Emprunter un livre</title>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Emprunter un livre</h1>

    <?php if (isset($erreur)): ?>
        <div class="alert alert-danger"><?php echo $erreur; ?></div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
</div>
</body>
</html>