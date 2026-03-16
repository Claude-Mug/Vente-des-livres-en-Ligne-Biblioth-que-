<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idClient'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérifier si l'ID du livre est passé en paramètre
if (!isset($_GET['id'])) {
    header("Location: mes_emprunts.php"); // Rediriger si l'ID est manquant
    exit();
}

$idLivre = $_GET['id'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer le fichier PDF du livre
$livreQuery = "SELECT Fichier FROM livres WHERE IdLivre = ?";
$stmt = $conn->prepare($livreQuery);
$stmt->bind_param("i", $idLivre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Livre non trouvé.");
}

$livre = $result->fetch_assoc();
$fichierPDF = "uploads/files/" . htmlspecialchars($livre['Fichier']);

$conn->close();

// Vérifier si le fichier PDF existe
if (!file_exists($fichierPDF)) {
    die("Fichier PDF non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Lire le livre</title>
    <!-- Intégrer PDF.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <style>
        #pdf-viewer {
            width: 100%;
            height: 90vh;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
    <script>
        // Désactiver le clic droit pour empêcher le téléchargement
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Désactiver les touches Ctrl + S (sauvegarder) et Ctrl + P (imprimer)
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && (e.key === 's' || e.key === 'p')) {
                e.preventDefault();
                alert("Le téléchargement et l'impression sont désactivés.");
            }
        });

        // Fonction pour charger le PDF en morceaux (chunks) via PHP
        async function chargerPDF() {
            const pdfUrl = "lire_pdf.php?id=<?php echo $idLivre; ?>"; // URL pour servir le PDF en morceaux
            const pdfContainer = document.getElementById('pdf-viewer');

            try {
                // Charger le PDF avec PDF.js
                const loadingTask = pdfjsLib.getDocument(pdfUrl);
                const pdf = await loadingTask.promise;

                // Afficher la première page
                const page = await pdf.getPage(1);
                const scale = 1.5;
                const viewport = page.getViewport({ scale });

                // Créer un canvas pour afficher la page
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Ajouter le canvas au conteneur
                pdfContainer.appendChild(canvas);

                // Rendre la page sur le canvas
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                await page.render(renderContext).promise;
            } catch (error) {
                console.error("Erreur lors du chargement du PDF :", error);
                pdfContainer.innerHTML = "<p class='text-danger'>Erreur lors du chargement du livre. Veuillez réessayer.</p>";
            }
        }

        // Charger le PDF au démarrage de la page
        window.onload = chargerPDF;
    </script>
</head>
<body>
    <h1>Lire le livre</h1>
    <p>Vous pouvez lire le livre directement dans cette page. Le téléchargement et l'impression sont désactivés.</p>

    <!-- Conteneur pour afficher le PDF -->
    <div id="pdf-viewer"></div>

    <a href="mes_emprunts.php" class="btn btn-secondary">Retour à mes emprunts</a>
</body>
</html>