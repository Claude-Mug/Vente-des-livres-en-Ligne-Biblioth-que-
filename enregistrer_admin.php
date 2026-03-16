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

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $email = $conn->real_escape_string($_POST['email']);
    $motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Requête SQL pour insérer un nouvel administrateur
    $sql = "INSERT INTO Admin (Nom, Prenom, Email, MotDePasse) VALUES ('$nom', '$prenom', '$email', '$motdepasse')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvel administrateur enregistré avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer un Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Masquer le contenu principal par défaut */
        #mainContent {
            display: none;
        }
    </style>
    <script>
        // Validation des identifiants dans le modal
        function validateAccess() {
            const usernameInput = document.getElementById("username").value.trim();
            const passwordInput = document.getElementById("password").value.trim();

            // Vérifiez les identifiants
            if (usernameInput === "Claude" && passwordInput === "Moscouw03") {
                // Masquer le modal et afficher le contenu principal
                const modal = document.getElementById("accessModal");
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                bootstrapModal.hide();

                // Afficher le contenu principal
                document.getElementById("mainContent").style.display = "block";
            } else {
                alert("Nom d'utilisateur ou mot de passe incorrect.");
            }
        }

        // Empêche l'utilisateur de modifier l'affichage avec le clavier
        window.onload = function () {
            const modal = new bootstrap.Modal(document.getElementById("accessModal"));
            modal.show();
        };
    </script>
</head>
<body>
    <!-- Modal de vérification -->
    <div class="modal fade" id="accessModal" tabindex="-1" aria-labelledby="accessModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accessModalLabel">Accès requis</h5>
                </div>
                <div class="modal-body">
                    <form id="accessForm" onsubmit="event.preventDefault(); validateAccess();">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="username" placeholder="Entrez votre nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de Passe</label>
                            <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal (masqué par défaut) -->
    <div class="container mt-5 col-md-6 bg-secondary-subtle" id="mainContent">
        <h2>Enregistrer un Administrateur</h2>
        <form action="enregistrer_admin.php" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="motdepasse" class="form-label">Mot de Passe</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword" onclick="togglePassword()">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonction pour afficher ou masquer le mot de passe
        function togglePassword() {
            const passwordInput = document.getElementById("motdepasse");
            const passwordToggle = document.getElementById("togglePassword");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.classList.remove("bi-eye");
                passwordToggle.classList.add("bi-eye-slash");
            } else {
                passwordInput.type = "password";
                passwordToggle.classList.remove("bi-eye-slash");
                passwordToggle.classList.add("bi-eye");
            }
        }
    </script>
</body>
</html>
