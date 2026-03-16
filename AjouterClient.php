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

// Ajouter un nouveau client
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $sexe = $conn->real_escape_string($_POST['sexe']);
    $email = $conn->real_escape_string($_POST['email']);
    $pays = $conn->real_escape_string($_POST['pays']);
    $ville = $conn->real_escape_string($_POST['ville']);
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe

    $sql = "INSERT INTO client (nom, prenom, sexe, email, pays, ville, mot_de_passe) VALUES ('$nom', '$prenom', '$sexe', '$email', '$pays', '$ville', '$mot_de_passe')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Client ajouté avec succès !'); window.location='clients.php';</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-primary">Créer un Compte</h1>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>