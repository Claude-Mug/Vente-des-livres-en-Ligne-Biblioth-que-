<?php
session_start();

// Rediriger vers le panier si l'utilisateur est déjà connecté
if (isset($_SESSION['idClient'])) {
    header("Location: panier.php");
    exit();
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier si l'utilisateur existe
    $stmt = $conn->prepare("SELECT idClient, mot_de_passe FROM Client WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idClient, $hashed_password);
        $stmt->fetch();
        
        // Vérifier le mot de passe
        if (password_verify($mot_de_passe, $hashed_password)) {
            // Le mot de passe est correct, rediriger vers panier.php
            $_SESSION['idClient'] = $idClient;

            // Vérifier si l'option "Se souvenir de moi" est cochée
            if (isset($_POST['remember_me'])) {
                // Créer un cookie pour garder l'utilisateur connecté
                setcookie("idClient", $idClient, time() + (86400 * 30), "/"); // 30 jours
            } else {
                // Si non, effacer le cookie
                if (isset($_COOKIE['idClient'])) {
                    setcookie("idClient", "", time() - 3600, "/");
                }
            }

            echo json_encode(["success" => true]);
        } else {
            // Mot de passe incorrect
            echo json_encode(["success" => false, "message" => "Mot de passe incorrect. Veuillez réessayer."]);
        }
    } else {
        // Utilisateur n'existe pas
        echo json_encode(["success" => false, "message" => "Utilisateur introuvable. Veuillez créer un compte."]);
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <title>Connexion</title>
</head>
<body>

<!-- Modale de connexion -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" method="POST">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="loginPassword" name="mot_de_passe" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="remember_me">
                        <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Me connecter</button>
                    <div id="loginError" class="alert alert-danger mt-3" style="display:none;"></div>
                </form>
                <div class="mt-3">
                    <a href="#">Mot de passe oublié ?</a>
                </div>
                <div class="mt-2">
                    <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#creerCompteModal" data-bs-dismiss="modal">Créer mon compte</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclure Bootstrap JS et jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // Ouvrir le modal automatiquement
    $('#loginModal').modal('show');

    // Gérer le formulaire de connexion
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Empêcher le comportement par défaut du formulaire

        // Envoyer les données via AJAX
        $.ajax({
            url: 'login.php', // URL pour le traitement des données
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    window.location.href = 'panier.php'; // Rediriger si la connexion est réussie
                } else {
                    $('#loginError').text(data.message).show(); // Afficher l'erreur
                }
            }
        });
    });
});
</script>

</body>
</html>