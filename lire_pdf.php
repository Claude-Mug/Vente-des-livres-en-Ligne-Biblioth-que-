<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idClient'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérifier si l'ID du livre est passé en paramètre
if (!isset($_GET['id'])) {
    header("Location: mes_emprunts.php"); // Rediriger si l'ID est manquant
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

// Récupérer le fichier PDF du livre
$livreQuery = "SELECT Fichier FROM livres WHERE IdLivre = ?";
$stmt = $conn->prepare($livreQuery);
$stmt->bind_param("i", $idLivre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Livre non trouvé.");
}

$livre = $result->fetch_assoc();
$fichierPDF = "uploads/files/" . htmlspecialchars($livre['Fichier']);

$conn->close();

// Vérifier si le fichier PDF existe
if (!file_exists($fichierPDF)) {
    die("Fichier PDF non trouvé.");
}

// Servir le PDF en morceaux (chunks)
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . basename($fichierPDF) . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($fichierPDF));

// Lire et envoyer le fichier PDF en morceaux
$handle = fopen($fichierPDF, 'rb');
while (!feof($handle)) {
    echo fread($handle, 8192); // Envoyer le fichier par morceaux de 8 Ko
    ob_flush();
    flush();
}
fclose($handle);
exit();
?>