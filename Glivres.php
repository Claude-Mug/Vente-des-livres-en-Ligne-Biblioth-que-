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

// Requête pour récupérer tous les livres
$sql = "SELECT IdLivre, Titre, Auteur, Categorie, SubCategorie, Prix, Devise, Couverture, Resume FROM livres";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Livres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function confirmDelete() {
            return confirm("Êtes-vous sûr de vouloir supprimer ce livre ?");
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Liste des Livres</h2>
        <div class="text-end mb-3">
            <a href="Livres.php" class="btn btn-primary">Ajouter un Livre</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>S-Cat</th>
                    <th>Prix</th>
                    <th>Devise</th>
                    <th>Couverture</th>
                    <th>Résumé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $resume = strlen($row['Resume']) > 50 ? substr($row['Resume'], 0, 50) . '...' : $row['Resume'];
                        $couverture = 'uploads/covers/' . $row['Couverture'];

                        echo "<tr>
                                <td>" . htmlspecialchars($row['IdLivre']) . "</td>
                                <td>" . htmlspecialchars($row['Titre']) . "</td>
                                <td>" . htmlspecialchars($row['Auteur']) . "</td>
                                <td>" . htmlspecialchars($row['Categorie']) . "</td>
                                <td>" . htmlspecialchars($row['SubCategorie']) . "</td>
                                <td>" . htmlspecialchars($row['Prix']) . "</td>
                                <td>" . htmlspecialchars($row['Devise']) . "</td>
                                <td><img src='" . htmlspecialchars($couverture) . "' alt='Couverture' style='width: 50px;'></td>
                                <td>" . htmlspecialchars($resume) . "</td>
                                <td>
                                    <a href='Modifier.php?IdLivre=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-warning'>Modifier</a>
                                    <a href='Suplivres.php?IdLivre=" . htmlspecialchars($row['IdLivre']) . "' class='btn btn-danger' onclick='return confirmDelete()'>Supprimer</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>Aucun livre trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
