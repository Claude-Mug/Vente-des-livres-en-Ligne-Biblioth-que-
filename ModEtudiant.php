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
    $idLiv = $_POST['idLiv'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie = $_POST['categorie'];
    $resume = $_POST['resume'];
    
    // Gestion de l'upload de la couverture
    if (isset($_FILES['couverture']) && $_FILES['couverture']['error'] == 0) {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $allowedExtensions = ['jpeg', 'png', 'jpg'];

        $fileMimeType = mime_content_type($_FILES['couverture']['tmp_name']);
        $fileExtension = strtolower(pathinfo($_FILES['couverture']['name'], PATHINFO_EXTENSION));

        if (in_array($fileMimeType, $allowedMimeTypes) && in_array($fileExtension, $allowedExtensions)) {
            $couverture = basename($_FILES['couverture']['name']);
            $couvertureTmpName = $_FILES['couverture']['tmp_name'];
            $couvertureFolder = 'FILES/cover/' . $couverture;

            if (move_uploaded_file($couvertureTmpName, $couvertureFolder)) {
                // Fichier téléchargé avec succès
            } else {
                // Utiliser l'ancienne couverture si le téléchargement échoue
                $couverture = $_POST['oldCouverture'];
            }
        } else {
            // Utiliser l'ancienne couverture si le type de fichier n'est pas autorisé
            $couverture = $_POST['oldCouverture'];
        }
    } else {
        // Utiliser l'ancienne couverture si aucun fichier n'est téléchargé
        $couverture = $_POST['oldCouverture'];
    }
    
    // Gestion de l'upload du fichier
    if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] == 0) {
        $fichier = basename($_FILES['fichier']['name']);
        $fichierTmpName = $_FILES['fichier']['tmp_name'];
        $fichierFolder = 'FILES/file/' . $fichier;

        if (move_uploaded_file($fichierTmpName, $fichierFolder)) {
            // Fichier téléchargé avec succès
        } else {
            // Utiliser l'ancien fichier si le téléchargement échoue
            $fichier = $_POST['oldFichier'];
        }
    } else {
        // Utiliser l'ancien fichier si aucun fichier n'est téléchargé
        $fichier = $_POST['oldFichier'];
    }

    $sqlUpdate = "UPDATE livreetudiant SET titre=?, auteur=?, categorie=?, resume=?, couverture=?, fichier=? WHERE idLiv=?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssssssi", $titre, $auteur, $categorie, $resume, $couverture, $fichier, $idLiv);

    if ($stmtUpdate->execute()) {
        header("Location: GEtudiant.php"); // Redirection vers GEtudiant.php après la mise à jour
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Erreur lors de la mise à jour: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();
}

$idLiv = $_GET['idLiv'];
$sqlLivre = "SELECT * FROM livreetudiant WHERE idLiv=?";
$stmtLivre = $conn->prepare($sqlLivre);
$stmtLivre->bind_param("i", $idLiv);
$stmtLivre->execute();
$resultLivre = $stmtLivre->get_result();

if ($resultLivre->num_rows == 0) {
    die("Livre non trouvé.");
}

$livre = $resultLivre->fetch_assoc();
$stmtLivre->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Livre Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <h2 class="text-center text-primary">Modifier le Livre Étudiant</h2>
        <form method="POST" action="ModifierEtudiant.php" enctype="multipart/form-data">
            <input type="hidden" name="idLiv" value="<?php echo htmlspecialchars($livre['idLiv']); ?>">
            <input type="hidden" name="oldCouverture" value="<?php echo htmlspecialchars($livre['couverture']); ?>">
            <input type="hidden" name="oldFichier" value="<?php echo htmlspecialchars($livre['fichier']); ?>">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($livre['titre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="auteur" class="form-label">Auteur</label>
                <input type="text" class="form-control" id="auteur" name="auteur" value="<?php echo htmlspecialchars($livre['auteur']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo htmlspecialchars($livre['categorie']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="resume" class="form-label">Résumé</label>
                <textarea class="form-control" id="resume" name="resume" rows="3" required><?php echo htmlspecialchars($livre['resume']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="couverture" class="form-label">Couverture</label>
                <input type="file" class="form-control" id="couverture" name="couverture" accept=".jpg, .jpeg, .png">
                <img src="FILES/cover/<?php echo htmlspecialchars($livre['couverture']); ?>" alt="Couverture actuelle" style="width: 100px; margin-top: 10px;">
            </div>
            <div class="mb-3">
                <label for="fichier" class="form-label">Fichier</label>
                <input type="file" class="form-control" id="fichier" name="fichier">
                <a href="FILES/file/<?php echo htmlspecialchars($livre['fichier']); ?>" target="_blank">Voir le fichier actuel</a>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="GEtudiant.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
