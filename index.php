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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <title>Vente des livres</title>
    <style>
        .fixed-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            border: 4px solid red; /* Bordure pour visualiser */
        }
        .fixed-sidebar {
            position: fixed;
            top: 70px; /* Ajustez selon la hauteur de l'en-tête */
            bottom: 0;
            width: 22%;
            overflow-y: auto;
            border: 2px solid green; /* Bordure pour visualiser */
        }
        .main-content {
            margin-left: 22.5%;
            padding-top: 80px; /* Ajustez selon la hauteur de l'en-tête */
            border: 2px solid blue; /* Bordure pour visualiser */
        }
        img {
    width: 100%; /* L'image prendra 100% de la largeur du conteneur */
    height: 5%; /* La hauteur s'ajustera automatiquement */
}
    </style>
</head>
<body>
    <header class="fixed-header bg-black bg-opacity-70 text-white p-1">
        
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class=" text-bg-primary navbar-brand" href="#">Bibliotheque</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-3 bg-danger">
                    <li class="nav-item">
                        <li>
                        <button id="resetButton" class="btn btn-danger">Accueil</button>
                        </li>
                        <a class="nav-link" href="#" onclick="loadPage('Apropos.php')">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadPage('Etudiant.php')">Étudiant</a>
                    </li>
                </ul>
                <div class="container w-auto mt-1">
        <form class="d-flex" onsubmit="return handleSearch(event)">
            <input class="form-control me-2" type="search" name="query" placeholder="Rechercher" aria-label="Search" required>
            <button class="btn btn-outline-primary btn-sm" type="submit">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </form>
    </div>

    <script>
        function handleSearch(event) {
            event.preventDefault(); // Empêche l'envoi normal du formulaire
            const query = document.querySelector('input[name="query"]').value;
            const url = 'recherche.php?query=' + encodeURIComponent(query); // Crée l'URL
            window.location.href = url; // Redirige vers la page de résultats
        }
    </script>

                        <button type="button" class="btn btn-outline-primary bg-black" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Se connecter
                        </button>
                        <a href="login0.php" class="btn btn-outline-primary btn-sm ms-2">
                            <i class="fas fa-shopping-cart"></i> Mon panier
                        </a>

                        <button type="button" class="btn btn-outline-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#creerCompteModal">
                            <i class="fas fa-user-plus"></i> Créer un compte
                        </button>

                    </form>
                </div>

                
                
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
            </div>
        </nav>
    </header>
    <div class="d-flex mt-4">
        <nav class="fixed-sidebar bg-info p-4">
            <ul class="nav flex-column">
                <h7 class="invisible">Tous ici</h7>
                <h5 class="bg-success text-warning text-center m-2">Tous nos catégories des livres ici</h5>
                <div class="bg-dark-subtle">
                <li class="nav-item ">
                    <a class="nav-link" href="#" onclick="loadPage('Informatique.php')">Informatique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('Sciences.php')">Sciences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('Construction.php')">Construction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('Mecanique.php')">Mecanique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('Droit.php')">Droit et entreprise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('Litterature.php')">Litterature</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('Loisire.php')">Art et Loisir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('ViePratique.php')">Vie pratique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('Voyage.php')">Voyage et tourisme</a>
                </li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="loadPage('Jeunesse.php')">Bd et Jeunesse</a>
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadPage('Graphisme.php')">Graphisme et Photo</a>
                </li>
            </div>
            </ul>
        </nav>
        
        <div class="main-content p-6">
            <div id="content">
                <section id="introduction">
                    <h6 classe="invisible">..</h6>
                    <img src="Image/Image1.jpeg" alt="Description de l'image" class="img-fluid">
                    <h2 class="text-center text-bg-success">Introduction aux Ventes de Livres</h2>
                    <p>
                        Le secteur des ventes de livres est en pleine mutation, influencé par des avancées technologiques et des changements dans les comportements des consommateurs. L'émergence des livres numériques a bouleversé les méthodes de lecture traditionnelles, permettant aux lecteurs d'accéder à une vaste bibliothèque à portée de main. Les plateformes de vente en ligne, telles qu'Amazon et d'autres détaillants numériques, ont également redéfini la manière dont les livres sont commercialisés, offrant des options de livraison rapide et une commodité sans précédent.

Les livres de fiction continuent de captiver un large public, avec des genres variés qui répondent aux goûts diversifiés des lecteurs. Les best-sellers et les tendances littéraires, souvent amplifiés par les réseaux sociaux, jouent un rôle clé dans la promotion des nouvelles parutions. De plus, les clubs de lecture en ligne et les critiques littéraires sur les plateformes numériques augmentent la visibilité des auteurs, qu'ils soient connus ou émergents.

En parallèle, le secteur de la non-fiction, qui englobe des sujets allant de l'autobiographie aux livres de développement personnel, connaît également une demande croissante. Les lecteurs recherchent des ouvrages qui offrent des perspectives nouvelles et des informations pratiques, ce qui alimente un marché florissant pour les livres spécialisés.

Les manuels scolaires et les livres éducatifs ont également évolué avec l'intégration de ressources numériques, facilitant l'apprentissage à distance et les environnements d'apprentissage hybrides. Cette tendance a été accentuée par la pandémie, qui a poussé les établissements scolaires à adopter des outils numériques.

Enfin, les défis persistent, notamment la nécessité de s'adapter à un marché saturé et à la concurrence des contenus gratuits en ligne. Les éditeurs et les auteurs doivent innover constamment pour attirer et fidéliser les lecteurs. En résumé, le secteur des ventes de livres, tout en étant confronté à des défis, reste dynamique et prometteur, avec des opportunités de croissance continue dans un paysage en constante évolution.
                    </p>
            <h3 class=" text-center text-primary">Nos Aperçus des livres ici</h3>

            <?php
// Configuration de la base de données
$host = 'localhost'; // Serveur local
$dbname = 'bibliotheque'; // Nom de la base de données
$username = 'root'; // Utilisateur par défaut de XAMPP
$password = ''; // Mot de passe par défaut (vide pour XAMPP)

// Essayer de se connecter à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour obtenir les 30 premiers livres
    $sql = "SELECT IdLivre, Titre, Auteur, Categorie, SubCategorie, Prix, Devise, Couverture, Resume, Fichier 
            FROM livres 
            LIMIT 30"; // Limite à 30 livres

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Affichage des résultats
    if ($stmt->rowCount() > 0) {
        echo "<h3 class='text-info text-decoration-underline text-center'>Pour explorer tout nos livres, regarder a droite de la page il y'a toutes les categories de nos livres</h3>";
        echo "<div class='row'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='col-md-4'>";
            echo "<div class='card mb-4'>";
            echo "<img src='uploads/covers/" . htmlspecialchars($row['Couverture']) . "' class='card-img-top' alt='Couverture du livre'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($row['Titre']) . "</h5>";
            echo "<p class='card-text'>Auteur: " . htmlspecialchars($row['Auteur']) . "</p>";
            echo "<p class='card-text'>Prix: " . htmlspecialchars($row['Prix']) . " " . htmlspecialchars($row['Devise']) . "</p>";
            echo "<p class='card-text'>" . displayResume(htmlspecialchars($row['Resume'])) . "</p>";
            $fichier = 'uploads/files/' . htmlspecialchars($row['Fichier']);
            echo "<a href='lire.php?fichier=" . urlencode($fichier) . "' class='btn btn-outline-primary'>Lire</a> ";
            echo "<a href='panier.php?id=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-outline-success'>Ajouter au panier</a> ";
            echo "<a href='empreinter.php?id=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-outline-danger m-1'>Emprunter</a>";
            echo "</div></div></div>";
        }
        echo "</div>";
    } else {
        echo "Aucun livre trouvé.";
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Fonction pour afficher le résumé
function displayResume($resume) {
    $maxWords = 50; // Limite à 50 mots
    $words = explode(' ', $resume);
    
    if (count($words) > $maxWords) {
        $shortResume = implode(' ', array_slice($words, 0, $maxWords)) . '...';
        // Créez un ID unique pour chaque résumé
        $id = uniqid('resume_');
        return "<span id='$id' class='resume-short'>$shortResume</span> 
                <span id='{$id}_full' style='display:none;' class='resume-full'>$resume</span> 
                <a href='javascript:void(0)' class='voir-plus' data-id='$id'>Voir plus</a>";
    }
    return $resume; // Retourne le résumé complet si inférieur à 50 mots
}



?>

<!-- Style CSS -->
<style>
.card-img-top {
    width: 100%; /* Remplit la largeur du conteneur */
    height: 200px; /* Hauteur fixe pour uniformiser */
    object-fit: cover; /* Ajuste l'image pour couvrir tout l'espace */
}
</style>

<!-- Inclusion de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script JavaScript -->
<script>
$(document).ready(function() {
    $('.voir-plus').on('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        var id = $(this).data('id');
        var shortResume = $('#' + id);
        var fullResume = $('#' + id + '_full');
        
        if (shortResume.is(':visible')) {
            shortResume.hide();
            fullResume.show();
            $(this).text('Voir moins'); // Change le texte du lien
        } else {
            shortResume.show();
            fullResume.hide();
            $(this).text('Voir plus'); // Remet le texte d'origine
        }
        document.addEventListener("DOMContentLoaded", function() {
            applyVoirPlusFunctionality(); // Fonctionnalité "Voir plus" initiale
        });
    });
});
</script>

            </div>   
        </div>    
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="voirplus.js"></script> <!-- Inclure le fichier voirplus.js -->
    <script>
        function loadPage(url) {
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Réseau non disponible');
                    }
                    return response.text();
                })
                .then(data => {
                    document.getElementById('content').innerHTML = data;
                    applyVoirPlusFunctionality(); // Réapplique la fonctionnalité "Voir plus"
                })
                .catch(error => {
                    console.error('Erreur lors du chargement de la page :', error);
                    loadHomeContent(); // Revenir à la page d'accueil en cas d'erreur
                });
        }

        document.addEventListener("DOMContentLoaded", function() {
            var resetButton = document.getElementById("resetButton");
            resetButton.addEventListener("click", function() {
                // Rediriger vers la page d'accueil
                window.location.href = window.location.origin;
            });

            // Ajouter des gestionnaires d'événements aux liens d'ancrage
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>

<!-- Bouton Se connecter -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
    Se connecter
</button>

<!-- Modale de connexion -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="loginPassword" name="mot_de_passe" required>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loginForm = document.getElementById("loginForm");

        loginForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche la soumission du formulaire par défaut

            const errorDiv = document.getElementById("loginError");
            errorDiv.style.display = 'none'; // Cacher les anciens messages d'erreur

            fetch(loginForm.action, {
                method: loginForm.method,
                body: new FormData(loginForm),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erreur réseau");
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Redirection en cas de succès
                    window.location.href = 'panier.php';
                } else {
                    // Afficher le message d'erreur sous le modal
                    errorDiv.textContent = data.message;
                    errorDiv.style.display = 'block';
                }
            })
            .catch(() => {
                // Afficher un message d'erreur générique
                errorDiv.textContent = "Une erreur est survenue. Veuillez réessayer.";
                errorDiv.style.display = 'block';
            });
        });
    });
</script>


<!-- Modal pour le bouton creer un compte -->

<div class="modal fade" id="creerCompteModal" tabindex="-1" aria-labelledby="creerCompteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="creerCompteModalLabel">Créer un Compte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" action="Client.php" method="POST">
                    <div class="mb-3">
                        <label for="registerLastName" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="registerLastName" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerFirstName" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="registerFirstName" name="prenom" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="registerPassword" name="mot_de_passe" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="country" class="form-label">Pays</label>
                        <select class="form-select" id="country" name="pays" required onchange="toggleOtherCountryInput()">
                            <option value="">Sélectionnez un pays</option>
                            <option value="Burundi">Burundi</option>
                            <option value="R.D.Congo">R.D.Congo</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Uganda">Uganda</option>
                            <option value="France">France</option>
                            <option value="Belgique">Belgique</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Amerique">Amerique</option>
                            <option value="Cameroun">Cameroun</option>
                            <option value="Canada">Canada</option>
                            <option value="Tanzanie">Tanzanie</option>
                            <option value="Afrique du sud">Afrique du sud</option>
                            <option value="Autres">Autres</option>
                        </select>
                        </div>
                    <div class="mb-3" id="otherCountryInput" style="display: none;">
                        <label for="otherCountry" class="form-label">Veuillez spécifier votre pays</label>
                        <input type="text" class="form-control" id="otherCountry" name="autre_pays">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="city" name="ville" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sexe</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexe" id="genderMale" value="Homme" required>
                                <label class="form-check-label" for="genderMale">Homme</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexe" id="genderFemale" value="Femme" required>
                                <label class="form-check-label" for="genderFemale">Femme</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                        <label class="form-check-label" for="newsletter">
                            Je m'abonne aux newsletters Bibliothèque thématiques
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="partnerOffers" name="partner_offers">
                        <label class="form-check-label" for="partnerOffers">
                            Je souhaite recevoir les offres des partenaires Bibliothèque
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Soumettre</button>
                </form>
              
                <script>
                    function toggleOtherCountryInput() {
                        const countrySelect = document.getElementById('country');
                        const otherCountryInput = document.getElementById('otherCountryInput');
                    
                        if (countrySelect.value === 'Autres') {
                            otherCountryInput.style.display = 'block'; // Afficher le champ de saisie
                        } else {
                            otherCountryInput.style.display = 'none'; // Masquer le champ de saisie
                            document.getElementById('otherCountry').value = ''; // Réinitialiser le champ
                        }
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        // Réinitialiser les champs du formulaire après la fermeture du modal
                        document.getElementById("creerCompteModal").addEventListener("hidden.bs.modal", function() {
                            var registerForm = document.getElementById("registerForm");
                            registerForm.reset();
                            document.getElementById("otherCountryInput").style.display = 'none';
                            document.getElementById("registerError").style.display = 'none';
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>

                </form>
            </div>
        </div>
    </div>
</div>
</html>


