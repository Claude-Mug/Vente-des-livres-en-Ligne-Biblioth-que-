<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Afficher PDF</title>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        #pdf-viewer {
            width: 80%;
            height: 80vh;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h2>PDF Affiché</h2>
    <canvas id="pdf-viewer"></canvas>
    <script>
        const url = 'lire_pdf.php?id=<?php echo intval($_GET["id"]); ?>'; // URL pour récupérer le PDF
        const loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                const scale = 1.5;
                const viewport = page.getViewport({ scale: scale });
                const canvas = document.getElementById('pdf-viewer');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        });
    </script>
</body>
</html>