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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </head>
<body>
    <header class="bg-secondary text-white text-center py-3 d-flex justify-content-between align-items-center">
        <h1 class="text-center">À Propos</h1>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
    <i class="bi bi-key bi-arrow-return-left"></i> Admin
</a>
    </header>
    <div class="container mt-4">
        <p>Nous sommes passionnés par l'électronique et déterminés à changer le monde à travers la lecture. Dans un monde en constante évolution, la connaissance est la clé du succès. Chaque livre contient un trésor de savoirs, et celui qui ne lit pas est condamné à écouter les autres.</p>
        
        <p>En tant qu'étudiants derrière ce site, nous croyons fermement que la lecture est essentielle pour transformer notre avenir, en particulier en Afrique. La connaissance acquise par la lecture nous permet de prendre des décisions éclairées et de contribuer positivement à notre société.</p>

        <h2>Citations des Grands Philosophes</h2>
        <blockquote>
            <p>"Le seul vrai voyage, ce ne serait pas d’aller vers d’autres paysages, mais d’avoir d’autres yeux." - Marcel Proust</p>
        </blockquote>
        <blockquote>
            <p>"La lecture est à l’esprit ce que l’exercice est au corps." - Joseph Addison</p>
        </blockquote>
        <blockquote>
            <p>"Un livre est un jardin que l’on peut mettre dans sa poche." - Proverbe arabe</p>
        </blockquote>
        <blockquote>
            <p>"Le savoir est le pouvoir." - Francis Bacon</p>
        </blockquote>
        <blockquote>
            <p>"La connaissance, c’est la richesse de l’esprit." - Albert Einstein</p>
        </blockquote>
        <blockquote>
            <p>"Ceux qui ne lisent pas n'ont aucun avantage sur ceux qui ne peuvent pas lire." - Mark Twain</p>
        </blockquote>

        <h2>Nos Développeurs</h2>
        <div class="row mt-4 text-info">
            <div class="col text-center ">
                <img src="Image/Claude.jpg" alt="Mugisha Sebirayi Caude" class="img-fluid" style="max-width: 150px;">
                <h5>MUGISHA Sebirayi Caude</h5>
            </div>
            <div class="col text-center">
                <img src="Image/photo2.jpg" alt="Mugisha Bruce" class="img-fluid" style="max-width: 150px;">
                <h5>MUGISHA Bruce</h5>
            </div>
            <div class="col text-center">
                <img src="Image/Reine.jpg" alt="Mugisha Duse Reine" class="img-fluid" style="max-width: 150px;">
                <h5>MUGWANEZA Duse Reine</h5>
            </div>
        </div>

        <br><br><br><br>
        <h2>Contact</h2>
        <p>Pour nous contacter, veuillez remplir les informations ci-dessous :</p>
        <form class="mb-3 col-md-6 text-bg-info fa-up-right-and-down-left-from-center">
            <div>
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        
        <h2>Informations de Contact</h2>
        <p>Vous pouvez ajouter vos informations de contact ici manuellement.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Connexion Administrateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="loginAdmin.php" method="POST">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="motdepasse" class="form-label">Mot de Passe</label>
                        <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                    </div>
                    <div class="alert alert-danger" id="error-message" style="display:none;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary" id="submitLogin" form="loginForm">Se connecter</button>
            </div>
            
        </div>
    </div>
</div>
</html>