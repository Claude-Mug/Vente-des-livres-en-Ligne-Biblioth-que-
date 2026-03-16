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

// Récupérer les informations du client à modifier
if (isset($_GET['id'])) {
    $idclient = intval($_GET['id']);
    $sql = "SELECT * FROM client WHERE idclient = $idclient";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $client = $result->fetch_assoc();
    } else {
        die("Client introuvable !");
    }
}

// Mettre à jour les informations du client
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idclient = intval($_POST['idclient']);
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $sexe = $conn->real_escape_string($_POST['sexe']);
    $email = $conn->real_escape_string($_POST['email']);
    $pays = $conn->real_escape_string($_POST['pays']);
    $ville = $conn->real_escape_string($_POST['ville']);
    $mot_de_passe = $_POST['mot_de_passe'] ? password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) : null;

    // Construire la requête SQL de mise à jour
    if ($mot_de_passe) {
        $sql = "UPDATE client SET nom = '$nom', prenom = '$prenom', sexe = '$sexe', email = '$email', pays = '$pays', ville = '$ville', mot_de_passe = '$mot_de_passe' WHERE idclient = $idclient";
    } else {
        $sql = "UPDATE client SET nom = '$nom', prenom = '$prenom', sexe = '$sexe', email = '$email', pays = '$pays', ville = '$ville' WHERE idclient = $idclient";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Client modifié avec succès !'); window.location='GClients.php';</script>";
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier un Client</h2>
        <form action="ModClient.php" method="POST">
            <input type="hidden" name="idclient" value="<?php echo $client['idclient']; ?>">

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($client['prenom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe</label>
                <select class="form-select" id="sexe" name="sexe" required>
                    <option value="M" <?php if ($client['sexe'] == 'M') echo 'selected'; ?>>Masculin</option>
                    <option value="F" <?php if ($client['sexe'] == 'F') echo 'selected'; ?>>Féminin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="pays" class="form-label">Pays</label>
                <input type="text" class="form-control" id="pays" name="pays" value="<?php echo htmlspecialchars($client['pays']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" value="<?php echo htmlspecialchars($client['ville']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Nouveau mot de passe (laisser vide pour ne pas modifier)</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="GClients.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
