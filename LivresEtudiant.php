<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifiez si un ID a été passé pour modifier un livre
if (isset($_GET['idLiv'])) {
    $id = (int)$_GET['idLiv'];
    
    // Récupérer les informations du livre
    $query = "SELECT * FROM livreetudiant WHERE idLiv = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $livre = $result->fetch_assoc();
    $stmt->close();
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['idLiv'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie = $_POST['categorie'];
    $resume = $_POST['resume'];
    
    // Gérer l'upload du fichier PDF
    $fichier = $_FILES['fichier']['name'];
    $target_dir_file = "FILES/file/";
    $target_file_file = $target_dir_file . basename($fichier);
    
    if (!empty($fichier) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['fichier']['tmp_name'], $target_file_file);
    } else {
        $fichier = $livre['fichier']; // Conserver l'ancien fichier si aucune nouvelle image n'est uploadée
    }

    // Gérer l'upload de la couverture
    $couverture = $_FILES['couverture']['name'];
    $target_dir_cover = "FILES/cover/";
    $target_file_cover = $target_dir_cover . basename($couverture);
    
    if (!empty($couverture) && $_FILES['couverture']['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['couverture']['tmp_name'], $target_file_cover);
    } else {
        $couverture = $livre['couverture']; // Conserver l'ancienne couverture
    }

    // Mise à jour des informations du livre
    $query = "UPDATE livreetudiant SET titre = ?, auteur = ?, categorie = ?, fichier = ?, couverture = ?, resume = ? WHERE idLiv = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $titre, $auteur, $categorie, $fichier, $couverture, $resume, $id);

    if ($stmt->execute()) {
        header("Location: success_page.php"); // Remplacez par votre page de succès
        exit;
    } else {
        echo "Erreur lors de la mise à jour : " . $stmt->error;
    }

    $stmt->close();
}

// Fermez la connexion
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier Livre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h1>Modifier Livre</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <?php if (isset($livre)): ?>
            <input type="hidden" name="idLiv" value="<?php echo htmlspecialchars($livre['idLiv']); ?>">
            
            <div>
                <label>Titre:</label>
                <input type="text" name="titre" value="<?php echo htmlspecialchars($livre['titre']); ?>" required>
            </div>

            <div>
                <label>Auteur:</label>
                <input type="text" name="auteur" value="<?php echo htmlspecialchars($livre['auteur']); ?>" required>
            </div>

            <div>
                <label>Catégorie:</label>
                <input type="text" name="categorie" value="<?php echo htmlspecialchars($livre['categorie']); ?>" required>
            </div>

            <div>
                <label>Fichier actuel:</label>
                <p><?php echo htmlspecialchars($livre['fichier']); ?></p>
                <label>Fichier:</label>
                <input type="file" name="fichier" accept=".pdf,.doc,.docx">
            </div>

            <div>
                <label>Couverture actuelle:</label>
                <?php if (!empty($livre['couverture'])): ?>
                    <img src="<?php echo htmlspecialchars($livre['couverture']); ?>" alt="Couverture" style="max-width: 200px;">
                <?php else: ?>
                    <p>Aucune couverture disponible.</p>
                <?php endif; ?>
                <label>Couverture:</label>
                <input type="file" name="couverture" accept="image/*">
            </div>

            <div>
                <label>Résumé:</label>
                <textarea name="resume" required><?php echo htmlspecialchars($livre['resume']); ?></textarea>
            </div>

            <input type="submit" value="Mettre à jour" class="btn btn-success">
        <?php else: ?>
            <p>Aucun livre trouvé.</p>
        <?php endif; ?>
    </form>
</body>
</html>