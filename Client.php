<?php
// Activer l'affichage des erreurs (à enlever en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fonction pour afficher les erreurs
function afficherErreur($message) {
    echo "<div class='alert alert-danger mt-3'>" . htmlspecialchars($message) . "</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "bibliotheque"; 

    // Créer la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        afficherErreur("Connexion échouée : " . $conn->connect_error);
        exit();
    }

    // Préparer et lier
    $stmt = $conn->prepare("INSERT INTO Client (prenom, nom, email, mot_de_passe, sexe, pays, ville, newsletter, partner_offers) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssi", $prenom, $nom, $email, $mot_de_passe, $sexe, $pays, $ville, $newsletter, $partner_offers);

    // Définir les paramètres et exécuter
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $sexe = $_POST['sexe'];
    $pays = ($_POST['pays'] == 'Autres') ? $_POST['autre_pays'] : $_POST['pays'];
    $ville = $_POST['ville'];
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;
    $partner_offers = isset($_POST['partner_offers']) ? 1 : 0;

    // Exécuter l'insertion
    if ($stmt->execute()) {
        echo "<div class='alert alert-success mt-3'>Compte créé avec succès !</div>";
    } else {
        afficherErreur("Erreur lors de l'insertion dans la base de données : " . $stmt->error);
    }

    // Fermer la déclaration et la connexion
    $stmt->close();
    $conn->close();
}
?>
