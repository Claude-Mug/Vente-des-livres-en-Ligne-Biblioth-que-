function applyVoirPlusFunctionality() {
    document.querySelectorAll('.voir-plus').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien
            var id = this.getAttribute('data-id');
            var shortResume = document.getElementById(id);
            var fullResume = document.getElementById(id + '_full');

            if (shortResume.style.display === 'none') {
                shortResume.style.display = 'inline'; // Affiche le résumé court
                fullResume.style.display = 'none'; // Cache le résumé complet
                this.textContent = 'Voir moins'; // Change le texte du lien
            } else {
                shortResume.style.display = 'none'; // Cache le résumé court
                fullResume.style.display = 'inline'; // Affiche le résumé complet
                this.textContent = 'Voir plus'; // Remet le texte d'origine
            }
        });
    });
}

// Appel initial de la fonction lors du chargement du document
document.addEventListener("DOMContentLoaded", function() {
    applyVoirPlusFunctionality(); // Fonctionnalité "Voir plus" initiale
});

function applyVoirPlusFunctionality() {
    document.querySelectorAll('.voir-plus').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien
            var id = this.getAttribute('data-id');
            var shortResume = document.getElementById(id);
            var fullResume = document.getElementById(id + '_full');

            if (shortResume.style.display === 'none') {
                shortResume.style.display = 'inline'; // Affiche le résumé court
                fullResume.style.display = 'none'; // Cache le résumé complet
                this.textContent = 'Voir moins'; // Change le texte du lien
            } else {
                shortResume.style.display = 'none'; // Cache le résumé court
                fullResume.style.display = 'inline'; // Affiche le résumé complet
                this.textContent = 'Voir plus'; // Remet le texte d'origine
            }
        });
    });
}

// Fonction pour générer les résumés
function displayResume(resume) {
    const maxWords = 50; // Limite à 50 mots
    const words = resume.split(' ');
    
    if (words.length > maxWords) {
        const shortResume = words.slice(0, maxWords).join(' ') + '...';
        const id = 'resume_' + Date.now(); // Créez un ID unique basé sur le temps
        return `
            <span id='${id}' class='resume-short' style='display:none;'>${shortResume}</span>
            <span id='${id}_full' class='resume-full'>${resume}</span>
            <a href='javascript:void(0)' class='voir-plus' data-id='${id}'>Voir plus</a>
        `;
    }
    return resume; // Retourne le résumé complet si inférieur à 50 mots
}