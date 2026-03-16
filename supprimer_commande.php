<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idClient'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérifier si l'ID de la commande est passé en paramètre
if (!isset($_GET['id'])) {
    header("Location: mes_emprunts.php"); // Rediriger si l'ID est manquant
    exit();
}

$idCommande = $_GET['id'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Supprimer la commande de la base de données
$deleteQuery = "DELETE FROM commandes WHERE idCommande = ?";
$stmt = $conn->prepare($deleteQuery);
$stmt->bind_param("i", $idCommande);

if ($stmt->execute()) {
    // Rediriger vers la page des commandes avec un message de succès
    header("Location: mes_emprunts.php?message=Commande supprimée avec succès.");
    exit();
} else {
    // Rediriger vers la page des commandes avec un message d'erreur
    header("Location: mes_emprunts.php?error=Erreur lors de la suppression de la commande.");
    exit();
}

$conn->close();
?>