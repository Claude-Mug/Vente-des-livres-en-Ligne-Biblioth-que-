<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

if (isset($_GET['idLiv'])) {
    $idLiv = $_GET['idLiv'];

    // Supprimer le livre de la base de données
    $sqlDelete = "DELETE FROM livreetudiant WHERE idLiv=?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $idLiv);

    if ($stmtDelete->execute()) {
        // Rediriger vers GEtudiant.php après la suppression
        header("Location: GEtudiant.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Erreur lors de la suppression: " . $stmtDelete->error;
    }

    $stmtDelete->close();
} else {
    echo "ID de livre non spécifié.";
}

$conn->close();
?>
