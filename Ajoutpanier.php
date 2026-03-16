<?php
session_start();

// Vérifier si le client est connecté
if (!isset($_SESSION['idClient'])) {
    header("Location: login.php");
    exit();
}

$idClient = $_SESSION['idClient'];
$idLivre = isset($_GET['id']) ? $_GET['id'] : null; // Modifier ici

if ($idLivre === null) {
    die("ID du livre non spécifié.");
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Vérifier si le livre est déjà dans le panier
$sqlCheck = "SELECT * FROM Commandes WHERE idClient = ? AND IdLivre = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ii", $idClient, $idLivre);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    // Si le livre est déjà dans le panier, mettre à jour la quantité
    $sqlUpdate = "UPDATE Commandes SET quantite = quantite + 1 WHERE idClient = ? AND IdLivre = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ii", $idClient, $idLivre);

    if ($stmtUpdate->execute()) {
        echo "Quantité mise à jour avec succès!";
    } else {
        echo "Erreur: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();
} else {
    // Si le livre n'est pas dans le panier, l'ajouter avec une quantité de 1
    $sqlInsert = "INSERT INTO Commandes (idClient, IdLivre, quantite) VALUES (?, ?, 1)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("ii", $idClient, $idLivre);

    if ($stmtInsert->execute()) {
        echo "Livre ajouté au panier avec succès!";
    } else {
        echo "Erreur: " . $stmtInsert->error;
    }

    $stmtInsert->close();
}

$stmtCheck->close();
$conn->close();

// Rediriger vers le panier après l'ajout
header("Location: panier.php");
exit();
?>