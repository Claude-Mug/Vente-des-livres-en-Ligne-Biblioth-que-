<?php
require_once("Connexion.php"); // Inclure le fichier de connexion

// Établir la connexion à la base de données
try {
    $connect = new PDO('mysql:host=localhost;dbname=bibliotheque', 'username', 'password');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer et exécuter la requête SQL
    $res = "SELECT * FROM livres"; // Remplacez 'livres' par le nom de la table appropriée
    $result = $connect->prepare($res);
    $result->execute();

    // Récupérer les résultats
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        print_r($row); // Afficher les résultats (vous pouvez modifier selon vos besoins)
    }
} catch(PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotheque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid col-md-12"> <!-- Utiliser container-fluid pour la largeur complète -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <!-- Icône du bouton de navigation -->
        </button>
        <div class="collapse navbar-collapse" id="navbarNav"> <!-- Contenu de la navigation -->
            <ul class="navbar-nav"> <!-- Liste des éléments de navigation -->
                <li class="nav-item active"> 

                    <nav class="navbar navbar-light bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand bg-info" href="#">Mon Bibliothèque</a>
                            <form class="d-flex justify-content-end" role="search" id="searchForm" style="width: 70%;">
                                <input class="form-control me-1 form-control-lg border-primary rounded" type="search" placeholder="Rechercher" aria-label="Search" id="searchInput">
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-outline-info ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <i class="fas fa-user"></i> Mon Compte
                                </button>
                                <button class="btn btn-outline-info ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <i class="fas fa-user"></i> Connexion
                                </button>

                                <a href="/Header.html" class="btn btn-outline-success ms-2" title="Mon Panier">
                                    <i class="fas fa-shopping-cart"></i> Mon Panier
                                </a>
                            </form>
                        </div>
                    </nav>
                    
                    <!-- Modale de connexion -->
                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="loginForm">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="firstName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="lastName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Me connecter</button>
                                    </form>
                                    <div class="mt-3">
                                        <a href="#">Mot de passe oublié ?</a>
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Créer mon compte</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modale de création de compte -->
                    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registerModalLabel">Créer un Compte</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="registerForm">
                                        <div class="mb-3">
                                            <label for="registerFirstName" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="registerFirstName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="registerLastName" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="registerLastName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="registerEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="registerEmail" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="registerPassword" class="form-label">Mot de passe</label>
                                            <input type="password" class="form-control" id="registerPassword" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sexe</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Homme" required>
                                                    <label class="form-check-label" for="genderMale">Homme</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Femme" required>
                                                    <label class="form-check-label" for="genderFemale">Femme</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Pays</label>
                                            <select class="form-select" id="country" required>
                                                <option value="">Sélectionnez un pays</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="R.D.Congo">R.D.Congo</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="France">France</option>
                                                <option value="Belgique">Belgique</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Unite States">Unite States</option>
                                                <option value="Cameroun">Cameroun</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Tanzanie">Tanzanie</option>
                                                <option value="Afrique du sud">Afrique du sud</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="city" class="form-label">Ville</label>
                                            <input type="text" class="form-control" id="city" required>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newsletter">
                                            <label class="form-check-label" for="newsletter">
                                                Je m'abonne aux newsletters Bibliothèque thématiques
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="partnerOffers">
                                            <label class="form-check-label" for="partnerOffers">
                                                Je souhaite recevoir les offres des partenaires Bibliothèque
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Soumettre</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        document.getElementById('searchForm').addEventListener('submit', function(event) {
                            event.preventDefault(); 
                            const query = document.getElementById('searchInput').value;
                            alert('Recherche pour : ' + query); 
                        });
                    
                        document.getElementById('loginForm').addEventListener('submit', function(event) {
                            event.preventDefault(); 
                            const firstName = document.getElementById('firstName').value;
                            const lastName = document.getElementById('lastName').value;
                            const email = document.getElementById('email').value;
                    
                            // Logique de connexion à ajouter ici
                            alert('Connexion pour : ' + firstName + ' ' + lastName + ' (' + email + ')');
                        });
                    
                        document.getElementById('registerForm').addEventListener('submit', function(event) {
                            event.preventDefault(); 
                            const registerFirstName = document.getElementById('registerFirstName').value;
                            const registerLastName = document.getElementById('registerLastName').value;
                            const registerEmail = document.getElementById('registerEmail').value;
                            const registerPassword = document.getElementById('registerPassword').value;
                            const country = document.getElementById('country').value;
                            const city = document.getElementById('city').value;
                            const newsletter = document.getElementById('newsletter').checked;
                            const partnerOffers = document.getElementById('partnerOffers').checked;
                    
                            alert('Création de compte pour : ' + registerFirstName + ' ' + registerLastName + ' (' + registerEmail + ')');
                            // Logique de création de compte à ajouter ici
                        });
                    </script>
                    
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<body class="bg-transparent">

    <div class="container bg-success p-3 rounded mt-12 left col-md-12 ">
        <div class="bg-danger p-3 rounded"> <!-- Arrière-plan pour le conteneur de boutons -->
            
            <div class="btn-group me-1 col text-end" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégorie
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/Infos.html">Graphisme & Photo</a></li>
                        <li><a class="dropdown-item" href="/Infos.html">Informatique</a></li>
                        <li><a class="dropdown-item" href="https://example.com/construction">Construction</a></li>
                        <li><a class="dropdown-item" href="https://example.com/business-law">Entreprise & Droit</a></li>
                        <li><a class="dropdown-item" href="https://example.com/sciences">Sciences</a></li>
                        <li><a class="dropdown-item" href="https://example.com/literature">Littérature</a></li>
                        <li><a class="dropdown-item" href="https://example.com/arts-leisure">Arts & Loisirs</a></li>
                        <li><a class="dropdown-item" href="https://example.com/practical-life">Vie pratique</a></li>
                        <li><a class="dropdown-item" href="https://example.com/travel-tourism">Voyage et Tourisme</a></li>
                        <li><a class="dropdown-item" href="/LivreInfo.html">BD et Jeunesse</a></li>
                    </ul>
                </div>

            <div class="btn-group me-2" role="group">
                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Informatique
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/Infos.html">Développement web</a></li>
                    <li><a class="dropdown-item" href="https://example.com/app-development">Développement d'applications</a></li>
                    <li><a class="dropdown-item" href="https://example.com/development-tools">Outils de développement</a></li>
                    <li><a class="dropdown-item" href="/Infos.html">Informatique d'entreprise</a></li>
                    <li><a class="dropdown-item" href="https://example.com/management-systems">Management des systèmes d'information</a></li>
                    <li><a class="dropdown-item" href="https://example.com/web-design">Conception et développement web</a></li>
                    <li><a class="dropdown-item" href="https://example.com/seo">Référencement de sites</a></li>
                    <li><a class="dropdown-item" href="https://example.com/operating-systems">Systèmes d'exploitation (Windows, UNIX, Linux)</a></li>
                    <li><a class="dropdown-item" href="https://example.com/hardware">Hardware et matériels</a></li>
                    <li><a class="dropdown-item" href="https://example.com/computer-architecture">Architecture des ordinateurs</a></li>
                    <li><a class="dropdown-item" href="https://example.com/electronics-for-it">Electronique pour l'informatique</a></li>
                    <li><a class="dropdown-item" href="https://example.com/peripherals">Périphériques</a></li>
                    <li><a class="dropdown-item" href="https://example.com/electronics">Electronique</a></li>
                    <li><a class="dropdown-item" href="https://example.com/databases">Bases de données</a></li>
                    <li><a class="dropdown-item" href="https://example.com/object-databases">Bases de données objet et objet relationnelles</a></li>
                    <li><a class="dropdown-item" href="https://example.com/networks">Réseaux et télécommunications</a></li>
                    <li><a class="dropdown-item" href="https://example.com/general-works">Ouvrages généraux</a></li>
                </ul>
            </div>

            <div class="btn-group me-2" role="group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Science
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="https://example.com/mathematics">Mathématiques</a></li>
                    <li><a class="dropdown-item" href="https://example.com/physics">Physique</a></li>
                    <li><a class="dropdown-item" href="https://example.com/mechanics">Mécanique</a></li>
                    <li><a class="dropdown-item" href="https://example.com/chemistry">Chimie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/life-sciences">Sciences de la vie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/biology">Biologie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/earth-sciences">Sciences de la terre</a></li>
                    <li><a class="dropdown-item" href="https://example.com/atmospheric-physics">Physique de l'atmosphère et climatologie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/seismology">Sismologie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/geology">Géologie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/techniques">Techniques</a></li>
                    <li><a class="dropdown-item" href="https://example.com/electricity-electrotechnics">Electricité et électrotechnique</a></li>
                    <li><a class="dropdown-item" href="https://example.com/electronics">Electronique</a></li>
                    <li><a class="dropdown-item" href="https://example.com/industrial-drawing">Dessin industriel</a></li>
                    <li><a class="dropdown-item" href="https://example.com/astronomy">Astronomie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/medicine-biology">Médecine et biologie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/earth-science-environment">Sciences de la Terre et environnement</a></li>
                </ul>
            </div>

            <div class="btn-group me-2" role="group">
                <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #007bff; color: #ffffff;">
                    Construction
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="https://example.com/architecture">Architecture</a></li>
                    <li><a class="dropdown-item" href="https://example.com/plans-drawings">Plans - Dessins</a></li>
                    <li><a class="dropdown-item" href="https://example.com/structure">Gros oeuvre et structure</a></li>
                    <li><a class="dropdown-item" href="https://example.com/concrete">Construction béton, béton armé et précontraint</a></li>
                    <li><a class="dropdown-item" href="https://example.com/walls-floors-ceilings">Murs - Sols - Plafonds</a></li>
                    <li><a class="dropdown-item" href="https://example.com/openings-stairs-elevators">Ouvertures - Escalier - Ascenseur</a></li>
                    <li><a class="dropdown-item" href="https://example.com/heating-ventilation">Chauffage - Ventilation - Cheminée</a></li>
                    <li><a class="dropdown-item" href="https://example.com/building-renovation">Réhabilitation bâtiment</a></li>
                    <li><a class="dropdown-item" href="https://example.com/public-works">Travaux publics</a></li>
                    <li><a class="dropdown-item" href="https://example.com/civil-engineering">Ouvrages d'art - Génie civil</a></li>
                    <li><a class="dropdown-item" href="https://example.com/bridges">Ponts</a></li>
                    <li><a class="dropdown-item" href="https://example.com/hydraulics">Hydraulique - Travaux fluviaux et maritimes</a></li>
                    <li><a class="dropdown-item" href="https://example.com/urban-planning">Urbanisme</a></li>
                </ul>
            </div>

            <div class="btn-group me-2" role="group">
                <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #ffc107; color: #ffffff;">
                    Entreprise&Droit
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="https://example.com/economics">Economie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/macro-microeconomics">Macroéconomie - Microéconomie</a></li>
                    <li><a class="dropdown-item" href="https://example.com/startup-creation">Création d'entreprise</a></li>
                    <li><a class="dropdown-item" href="https://example.com/consultant-freelance">Consultant - Freelance - TPE - Etc.</a></li>
                    <li><a class="dropdown-item" href="https://example.com/sme-commerce-export">PME - Commerçant - Exportation</a></li>
                    <li><a class="dropdown-item" href="https://example.com/business-plan">Business plan</a></li>
                    <li><a class="dropdown-item" href="https://example.com/strategy-management">Stratégie - Direction d'entreprise</a></li>
                    <li><a class="dropdown-item" href="https://example.com/military-political-strategy">Stratégie militaire et politique</a></li>
                    <li><a class="dropdown-item" href="https://example.com/hr-training">RH et formation</a></li>
                    <li><a class="dropdown-item" href="https://example.com/recruitment">Recrutement</a></li>
                    <li><a class="dropdown-item" href="https://example.com/evaluation">Evaluation</a></li>
                    <li><a class="dropdown-item" href="https://example.com/marketing-sales">Marketing et vente</a></li>
                    <li><a class="dropdown-item" href="https://example.com/commercial-management">Management commercial</a></li>
                    <li><a class="dropdown-item" href="https://example.com/sales-techniques-negotiation">Techniques de vente - Négociation</a></li>
                    <li><a class="dropdown-item" href="https://example.com/finance-accounting">Finance - Comptabilité</a></li>
                    <li><a class="dropdown-item" href="https://example.com/governance">Gouvernance</a></li>
                </ul>
            </div>

            <div class="btn-group me-2" role="group">
                <button type="button" class="btn-danger dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #6c757d;">
                    Littérature
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="https://example.com/literary-novels-2024">Romans - Rentrée littéraire 2024</a></li>
                    <li><a class="dropdown-item" href="https://example.com/police-thriller">Policier - Thriller</a></li>
                    <li><a class="dropdown-item" href="https://example.com/science-fiction-fantasy">Science Fiction - Fantasy</a></li>
                    <li><a class="dropdown-item" href="https://example.com/historical-novels">Roman historique</a></li>
                    <li><a class="dropdown-item" href="https://example.com/humor">Humour</a></li>
                    <li><a class="dropdown-item" href="https://example.com/theater">Théâtre</a></li>
                    <li><a class="dropdown-item" href="https://example.com/poetry">Poésie</a></li>
                </ul>
            </div>

            <div class="btn-group me-2" role="group">
                <button type="button" class="btn btn-secondary dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #6c757d;">
                    Vie pratique
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="https://example.com/health-wellness">Santé et bien-être</a></li>
                    <li><a class="dropdown-item" href="https://example.com/spirituality">Spiritualité</a></li>
                    <li><a class="dropdown-item" href="https://example.com/sport-beauty">Sport - Forme - Beauté</a></li>
                    <li><a class="dropdown-item" href="https://example.com/family-life">Vie de famille</a></li>
                    <li><a class="dropdown-item" href="https://example.com/sexuality">Sexualité</a></li>
                    <li><a class="dropdown-item" href="https://example.com/seduction">Séduction</a></li>
                    <li><a class="dropdown-item" href="https://example.com/couple">Couple</a></li>
                    <li><a class="dropdown-item" href="https://example.com/cuisine-tips">Cuisine, Trucs et astuces</a></li>
                </ul>
            </div>

            <div class="btn-group me-2" role="group">
                <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #28a745; color: #ffffff;">
                    BD et Jeunesse
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="https://example.com/bd-mangas-comics">BD - Mangas - Comics</a></li>
                    <li><a class="dropdown-item" href="https://example.com/comics">Bande dessinée</a></li>
                    <li><a class="dropdown-item" href="https://example.com/adult-content">Public averti</a></li>
                    <li><a class="dropdown-item" href="https://example.com/youth">Jeunesse</a></li>
                </ul>
            </div>

        </div>
    </div>

</head>

</div>  
</nav>
<br>
<h1 class="text-center text-white bg-info">Accueil</h1>
<h1 class="text-center text-white bg-info">Accueil</h1>
<h1 class="text-center text-white bg-info">Accueil</h1>

    <div class="text-center container mt-9 style="margin-top: 70px">
        <h2 class="text-bg-secondary col-md-12 mx-auto mt-4">Description</h2>
        <p class="mt-4 container style="margin-top: 70px">Bienvenue sur notre site, votre destination privilégiée pour l'achat de livres de tous genres. Que vous soyez passionné de romans captivants, amateur de bandes dessinées, ou en quête de manuels académiques, nous avons quelque chose pour chaque lecteur. Notre collection soigneusement sélectionnée comprend des œuvres des dernières rentrées littéraires, des classiques intemporels, ainsi que des ouvrages sur des sujets variés comme la santé, la spiritualité, et bien plus encore. Explorez notre plateforme conviviale pour découvrir de nouvelles lectures, profiter de conseils et de recommandations, et bénéficier d'offres spéciales. Rejoignez-nous dans cette aventure littéraire et enrichissez votre bibliothèque dès aujourd'hui !</p>
    </div>


    <div class="container mt-5">
        <h1 class="text-center mb-4 text-bg-secondary">Catégories de Livres</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Graphisme & Photo</h5>
                        <p>Les livres sur le graphisme et la photographie offrent une richesse de connaissances et d'inspiration pour les créateurs de tous niveaux. Dans le domaine du graphisme, ils abordent des concepts essentiels tels que la théorie des couleurs, la typographie et le design d'interaction, permettant aux lecteurs de développer des compétences techniques avec des logiciels comme Adobe Photoshop et Illustrator. En parallèle, les ouvrages sur la photographie traitent des techniques de composition, de l'éclairage et de la manipulation des appareils photo, allant des réflex numériques aux smartphones. Ces livres encouragent l'expérimentation et la créativité, aidant les lecteurs à découvrir leur style personnel et à explorer différents genres, comme la photographie de portrait, de paysage ou de rue..</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Infos.html">Graphisme & Photo</a></ul>
                    </div>

                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Informatique</h5>
                        <p>Les livres sur l'informatique couvrent un large éventail de sujets allant des concepts fondamentaux de la programmation à des domaines spécialisés tels que la cybersécurité, l'intelligence artificielle et le développement web. Ils sont essentiels pour les étudiants, les professionnels et les passionnés qui souhaitent approfondir leurs connaissances et compétences. Ces ouvrages offrent non seulement des théories et des principes, mais aussi des applications pratiques à travers des exemples concrets et des projets. Que ce soit pour apprendre un nouveau langage de programmation, comprendre les architectures des systèmes informatiques ou explorer les dernières tendances en matière de technologie, les livres d'informatique constituent une ressource inestimable pour quiconque s'intéresse à ce domaine en constante évolution.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Infos.html">Informatique</a></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Construction</h5>
                        <p>Découvrez des ouvrages sur la construction, l'architecture et le génie civil. Apprenez les meilleures pratiques pour vos projets de construction. Ces livres couvrent des sujets essentiels tels que les matériaux de construction, les techniques de gestion de projet et les principes de design durable. Que vous soyez un professionnel du secteur ou un amateur passionné, ces ressources vous fourniront des connaissances approfondies et des conseils pratiques pour concrétiser vos idées. Ils explorent également les normes de sécurité et les innovations technologiques, vous permettant de rester à jour dans un domaine en constante évolution.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Construction">Construction</a></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Entreprise & Droit</h5>
                        <p>Informez-vous sur le monde des affaires et des lois. Des livres qui abordent le droit commercial et les stratégies de gestion d'entreprise.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Entreprise&Droit">Entreprise&Droit</a></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Sciences</h5>
                        <p>Explorez des livres traitant des différentes branches des sciences, y compris la biologie, la chimie et la physique. Idéal pour les passionnés de science.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Sciences">Sciences</a></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Littérature</h5>
                        <p>Une vaste sélection de romans, poésies et essais. Plongez dans le monde de la littérature classique et contemporaine.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Littérature">Littérature</a></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Arts & Loisirs</h5>
                        <p>Des livres sur les activités artistiques, le bricolage, et les loisirs créatifs. Libérez votre créativité avec des projets inspirants.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Arts & Loisirs.html">Arts & Loisirs</a></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Vie Pratique</h5>
                        <p>Des conseils pratiques pour améliorer votre quotidien, allant de la cuisine à la gestion du temps.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Infos.html">Vie Pratique</a></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">Voyage et Tourisme</h5>
                        <p>Préparez vos voyages avec des guides touristiques, des conseils d'itinéraires et des récits d'aventures.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Infos.html">Voyage et Tourisme</a></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="category-title">BD et Jeunesse</h5>
                        <p>Une sélection de bandes dessinées et de livres jeunesse qui raviront les enfants et les adolescents.</p>
                        Pour en savoir plus:
                        <ul><a class="dropdown-item text-danger " href="/Infos.html">BD et Jeunesse</a></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
require_once('connexion.php'); // Assurez-vous que le fichier de connexion existe et est correct

try {
    // Préparez la requête SQL pour sélectionner toutes les entrées de la table Livres
    $res = "SELECT * FROM Livres";
    $result = $connect->prepare($res);
    $result->execute();

    // Récupérez et affichez les résultats
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        echo "ID Livre: " . $row['IdLivre'] . "<br>";
        echo "Titre: " . $row['Titre'] . "<br>";
        echo "Auteur: " . $row['Auteur'] . "<br>";
        echo "Catégorie: " . $row['Categorie'] . "<br>";
        echo "Sous-catégorie: " . $row['SubCategorie'] . "<br>";
        echo "Prix: " . $row['Prix'] . "<br>";
        echo "Couverture: <br>";
        echo "<img src='" . $row['Couverture'] . "' alt='Couverture du livre' style='width:200px;height:auto;'><br>";
        echo "Résumé: " . $row['Resume'] . "<br>";
        echo "Fichier: <a href='" . $row['Fichier'] . "' target='_blank'>Voir le PDF</a><br>";
        echo "<hr>";
    }
} catch(PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>


