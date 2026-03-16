<?php
session_start();
header('Content-Type: application/json'); // Définir le type de contenu sur JSON

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connexion échouée: " . $conn->connect_error]));
}

// Déconnexion
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    echo json_encode(["success" => true, "message" => "Déconnexion réussie."]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    // Préparer la requête
    $stmt = $conn->prepare("SELECT idClient, mot_de_passe FROM Client WHERE email = ?");
    if (!$stmt) {
        die(json_encode(["success" => false, "message" => "Erreur de préparation de la requête: " . $conn->error]));
    }

    // Exécuter la requête
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Vérifier si l'utilisateur existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idClient, $hashed_password);
        $stmt->fetch();

        // Vérifier le mot de passe
        if (password_verify($mot_de_passe, $hashed_password)) {
            $_SESSION['idClient'] = $idClient;
            echo json_encode(["success" => true]); // Réponse JSON pour succès
        } else {
            echo json_encode(["success" => false, "message" => "Mot de passe incorrect. Veuillez réessayer."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Utilisateur introuvable. Veuillez créer un compte."]);
    }

    // Fermer la déclaration
    $stmt->close();
}

// Fermer la connexion
$conn->close();
?>