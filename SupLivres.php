<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Vérifier si l'ID du livre est passé en paramètre
if (isset($_GET['IdLivre'])) {
    $IdLivre = $_GET['IdLivre'];

    // Requête pour supprimer le livre
    $sql = "DELETE FROM livres WHERE IdLivre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $IdLivre);

    if ($stmt->execute()) {
        echo "Livre supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression: " . $stmt->error;
    }

    // Rediriger vers la liste des livres après suppression
    header("Location: liste_livres.php");
    exit;
} else {
    die("ID du livre manquant.");
}

$conn->close() ;

?>