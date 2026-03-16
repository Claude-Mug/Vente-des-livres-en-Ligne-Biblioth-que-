<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

// Créer la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Supprimer un client si une requête de suppression est envoyée
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql = "DELETE FROM client WHERE idclient = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Client supprimé avec succès !'); window.location='clients.php';</script>";
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }
}

// Récupérer tous les clients
$sql = "SELECT * FROM client";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Gestion des Clients</h2>

        <!-- Bouton pour ajouter un client -->
        <a href="AjouterClient.php" class="btn btn-primary mb-3">Ajouter un Client</a>
        
        <!-- Table des clients -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Email</th>
                    <th>Pays</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Afficher chaque client
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['idclient'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sexe']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['pays']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ville']) . "</td>";
                        echo "<td>
                                <a href='ModClient.php?id=" . $row['idclient'] . "' class='btn btn-warning btn-sm'>Modifier</a>
                                <a href='Supclients.php?delete_id=" . $row['idclient'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce client ?\");' class='btn btn-danger btn-sm'>Supprimer</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Aucun client trouvé.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
