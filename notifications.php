<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur
$password = ""; // Remplacez par votre mot de passe
$dbname = "bibliotheque"; // Nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Traitement du formulaire d'envoi de notification
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['message']) && !empty($_POST['idclient'])) {
    $message = $conn->real_escape_string($_POST['message']);
    $idclient = intval($_POST['idclient']);
    $scheduledDate = !empty($_POST['scheduled_date']) ? $conn->real_escape_string($_POST['scheduled_date']) : null;

    // Insertion dans la table notifications
    $sql = "INSERT INTO notifications (message, scheduled_date, idclient) VALUES ('$message', '$scheduledDate', '$idclient')";
    if ($conn->query($sql) === TRUE) {
        // Récupérer l'e-mail du client pour envoyer la notification par e-mail
        $emailResult = $conn->query("SELECT email FROM client WHERE idclient = $idclient");
        if ($emailResult->num_rows > 0) {
            $emailRow = $emailResult->fetch_assoc();
            $email = $emailRow['email'];

            // Envoi de l'e-mail
            $headers = "From: \"Nom de l'Expéditeur\" <votre_email@example.com>\r\n";
            $headers .= "Return-Path: votre_email@example.com\r\n";

            if (mail($email, "Nouvelle Notification", $message, $headers)) {
                $successMessage = "Notification envoyée avec succès par e-mail.";
            } else {
                $errorMessage = "Erreur lors de l'envoi de l'e-mail.";
            }
        } else {
            $errorMessage = "Client introuvable pour l'ID spécifié.";
        }
    } else {
        $errorMessage = "Erreur : " . $conn->error;
    }
}

// Récupérer les clients
$clients = $conn->query("SELECT idclient, nom, prenom FROM client");

// Récupérer les notifications
$sql = "SELECT n.message, n.date, n.scheduled_date, c.nom AS client_nom, c.prenom AS client_prenom FROM notifications n LEFT JOIN client c ON n.idclient = c.idclient ORDER BY n.date DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications Générales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Notifications Générales</h1>
        
        <!-- Formulaire d'envoi de notification -->
        <form method="POST" class="mb-4">
            <div class="form-group">
                <label for="message">Message</label>
                <input type="text" class="form-control" id="message" name="message" required>
            </div>
            <div class="form-group">
                <label for="idclient">Sélectionnez un Client</label>
                <select class="form-control" id="idclient" name="idclient" required>
                    <option value="">Choisissez un client</option>
                    <?php while ($client = $clients->fetch_assoc()): ?>
                        <option value="<?php echo $client['idclient']; ?>"><?php echo htmlspecialchars($client['nom'] . ' ' . $client['prenom']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="scheduled_date">Date de Programmation</label>
                <input type="datetime-local" class="form-control" id="scheduled_date" name="scheduled_date">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer Notification</button>
        </form>

        <!-- Affichage des notifications -->
        <div class="list-group">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="list-group-item">
                        <h5><?php echo htmlspecialchars($row['message']); ?> (Pour: <?php echo htmlspecialchars($row['client_nom'] . ' ' . $row['client_prenom']); ?>)</h5>
                        <small class="text-muted">
                            Envoyée le <?php echo date('d-m-Y H:i', strtotime($row['date'])); ?>
                            <?php if ($row['scheduled_date']): ?>
                                | Programmée pour <?php echo date('d-m-Y H:i', strtotime($row['scheduled_date'])); ?>
                            <?php endif; ?>
                        </small>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="list-group-item">
                    <p>Aucune notification à afficher.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success mt-3"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger mt-3"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>