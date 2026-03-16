<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

// Créer la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Supprimer un client si une requête de suppression est envoyée
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql = "DELETE FROM client WHERE idclient = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Client supprimé avec succès !'); window.location='GClients.php';</script>";
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }
} else {
    echo "<script>alert('ID de client manquant.'); window.location='GClients.php';</script>";
}

// Fermer la connexion
$conn->close();
?>