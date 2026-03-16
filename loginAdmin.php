<?php
session_start();

// Détails de la connexion à la base de données
$servername = "localhost";  // Remplacez par votre serveur
$username = "root";         // Votre nom d'utilisateur de base de données
$password = "";             // Votre mot de passe de base de données
$dbname = "bibliotheque";   // Le nom de votre base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    // Préparer une requête pour vérifier l'admin
    $stmt = $conn->prepare("SELECT Nom, MotDePasse FROM Admin WHERE Email = ? AND Nom = ?");
    $stmt->bind_param("ss", $email, $nom);
    
    // Exécuter la requête
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Informations valides, récupérer le nom et le mot de passe
        $row = $result->fetch_assoc();
        
        // Vérifier le mot de passe
        if (password_verify($motdepasse, $row['MotDePasse'])) {
            // Authentification réussie
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['nom'] = $row['Nom']; // Stocker le nom
            header("Location: admin1.php"); // Redirige vers la page admin
            exit();
        } else {
            // Mot de passe incorrect
            echo "Nom, email ou mot de passe incorrect.";
        }
    } else {
        // Email ou nom non trouvé
        echo "Nom, email ou mot de passe incorrect.";
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
    exit();
}
?>