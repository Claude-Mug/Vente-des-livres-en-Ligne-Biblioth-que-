<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idLivre = $_POST['IdLivre'];
    $titre = $_POST['Titre'];
    $auteur = $_POST['Auteur'];
    $categorie = $_POST['Categorie'];
    $prix = $_POST['Prix'];
    $devise = $_POST['Devise'];
    $resume = $_POST['Resume'];
    
    // Gestion de l'upload de la couverture
    $couverture = $_FILES['Couverture']['name'];
    $couvertureTmpName = $_FILES['Couverture']['tmp_name'];
    $couvertureFolder = 'uploads/covers/' . $couverture;

    if (move_uploaded_file($couvertureTmpName, $couvertureFolder)) {
        // Fichier téléchargé avec succès
    } else {
        // Utiliser l'ancienne couverture si le téléchargement échoue
        $couverture = $_POST['OldCouverture'];
    }
    
    // Gestion de l'upload du fichier
    $fichier = $_FILES['Fichier']['name'];
    $fichierTmpName = $_FILES['Fichier']['tmp_name'];
    $fichierFolder = 'uploads/files/' . $fichier;

    if (move_uploaded_file($fichierTmpName, $fichierFolder)) {
        // Fichier téléchargé avec succès
    } else {
        // Utiliser l'ancien fichier si le téléchargement échoue
        $fichier = $_POST['OldFichier'];
    }

    $sqlUpdate = "UPDATE livres SET Titre=?, Auteur=?, Categorie=?, Prix=?, Devise=?, Resume=?, Couverture=?, Fichier=? WHERE IdLivre=?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("sssdssssi", $titre, $auteur, $categorie, $prix, $devise, $resume, $couverture, $fichier, $idLivre);

    if ($stmtUpdate->execute()) {
        header("Location: Glivres.php"); // Redirection vers Glivres.php après la mise à jour
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Erreur lors de la mise à jour: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();
}

$idLivre = $_GET['IdLivre'];
$sqlLivre = "SELECT * FROM livres WHERE IdLivre=?";
$stmtLivre = $conn->prepare($sqlLivre);
$stmtLivre->bind_param("i", $idLivre);
$stmtLivre->execute();
$resultLivre = $stmtLivre->get_result();

if ($resultLivre->num_rows == 0) {
    die("Livre non trouvé.");
}

$livre = $resultLivre->fetch_assoc();
$stmtLivre->close();

// Récupérer les catégories
$sqlCategories = "SELECT * FROM categorie";
$resultCategories = $conn->query($sqlCategories);
$categories = [];
while ($row = $resultCategories->fetch_assoc()) {
    $categories[] = $row;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Livre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 col-md-6 text-secondary-emphasis bg-info-subtle">
        <h2 class="text-center">Modifier le Livre</h2>
        <form method="POST" action="Modifier.php" enctype="multipart/form-data">
            <input type="hidden" name="IdLivre" value="<?php echo htmlspecialchars($livre['IdLivre']); ?>">
            <input type="hidden" name="OldCouverture" value="<?php echo htmlspecialchars($livre['Couverture']); ?>">
            <input type="hidden" name="OldFichier" value="<?php echo htmlspecialchars($livre['Fichier']); ?>">
            <div class="mb-3">
                <label for="Titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="Titre" name="Titre" value="<?php echo htmlspecialchars($livre['Titre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Auteur" class="form-label">Auteur</label>
                <input type="text" class="form-control" id="Auteur" name="Auteur" value="<?php echo htmlspecialchars($livre['Auteur']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Categorie" class="form-label">Catégorie</label>
                <select class="form-select" id="Categorie" name="Categorie" required>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo htmlspecialchars($categorie['name']); ?>" <?php if ($categorie['name'] == $livre['Categorie']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($categorie['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Prix" class="form-label">Prix</label>
                <input type="number" step="0.01" class="form-control" id="Prix" name="Prix" value="<?php echo htmlspecialchars($livre['Prix']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Devise" class="form-label">Devise</label>
                <input type="text" class="form-control" id="Devise" name="Devise" value="<?php echo htmlspecialchars($livre['Devise']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="Couverture" class="form-label">Couverture</label>
                <input type="file" class="form-control" id="Couverture" name="Couverture" accept=".jpg, .jpeg, .png">
                <img src="uploads/covers/<?php echo htmlspecialchars($livre['Couverture']); ?>" alt="Couverture actuelle" style="width: 100px; margin-top: 10px;">
            </div>
            <div class="mb-3">
                <label for="Fichier" class="form-label">Fichier</label>
                <input type="file" class="form-control" id="Fichier" name="Fichier">
                <a href="uploads/files/<?php echo htmlspecialchars($livre['Fichier']); ?>" target="_blank">Voir le fichier actuel</a>
            </div>
            <div class="mb-3">
                <label for="Resume" class="form-label">Résumé</label>
                <textarea class="form-control" id="Resume" name="Resume" rows="3" required><?php echo htmlspecialchars($livre['Resume']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="ListeLivres.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
