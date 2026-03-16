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

// Requête pour récupérer tous les livres étudiant
$sql = "SELECT idLiv, titre, auteur, categorie, fichier, couverture, resume FROM livreetudiant";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Livres Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function confirmDelete() {
            return confirm("Êtes-vous sûr de vouloir supprimer ce livre ?");
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-primary">Liste des Livres Étudiants</h2>
        <div class="text-end mb-3">
            <a href="Insert_book.php" class="btn btn-primary">Ajouter un Livre Étudiant</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Fichier</th>
                    <th>Couverture</th>
                    <th>Résumé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $resume = strlen($row['resume']) > 50 ? substr($row['resume'], 0, 50) . '...' : $row['resume'];
                        $couverture = 'FILES/cover/' . $row['couverture'];
                        $fichier = 'FILES/file/' . $row['fichier'];

                        echo "<tr>
                                <td>" . htmlspecialchars($row['idLiv']) . "</td>
                                <td>" . htmlspecialchars($row['titre']) . "</td>
                                <td>" . htmlspecialchars($row['auteur']) . "</td>
                                <td>" . htmlspecialchars($row['categorie']) . "</td>
                                <td><a href='" . htmlspecialchars($fichier) . "' target='_blank'>Voir le PDF</a></td>
                                <td><img src='" . htmlspecialchars($couverture) . "' alt='Couverture' style='width: 50px;'></td>
                                <td>" . htmlspecialchars($resume) . "</td>
                                <td>
                                    <a href='ModEtudiant.php?idLiv=" . htmlspecialchars($row['idLiv']) . "' class='btn btn-warning'>Modifier</a>
                                    <a href='SupEtudiant.php?idLiv=" . htmlspecialchars($row['idLiv']) . "' class='btn btn-danger' onclick='return confirmDelete()'>Supprimer</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Aucun livre trouvé</td></tr>";
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

