// Sélectionner le formulaire de contact
const contactForm = document.getElementById('contact-form');

// Ajouter un écouteur d'événement pour la soumission du formulaire
contactForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Empêcher le comportement par défaut du formulaire

    // Récupérer les valeurs des champs du formulaire
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    // Valider les champs du formulaire
    if (!name || !email || !message) {
        alert('Veuillez remplir tous les champs du formulaire.');
        return;
    }

    // Envoyer les données du formulaire au serveur (simulation)
    sendContactForm(name, email, message)
        .then(() => {
            alert('Votre message a été envoyé avec succès !');
            contactForm.reset(); // Réinitialiser le formulaire
        })
        .catch((error) => {
            alert('Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer plus tard.');
            console.error('Erreur lors de l\'envoi du formulaire de contact :', error);
        });
});

/**
 * Fonction simulant l'envoi du formulaire de contact au serveur
 * @param {string} name - Le nom de l'utilisateur
 * @param {string} email - L'adresse email de l'utilisateur
 * @param {string} message - Le message de l'utilisateur
 * @returns {Promise<void>}
 */
function sendContactForm(name, email, message) {
    return new Promise((resolve, reject) => {
        // Simulation de l'envoi du formulaire au serveur
        setTimeout(() => {
            // Vérifier si le message contient des mots inappropriés
            if (message.toLowerCase().includes('spam')) {
                reject(new Error('Le message contient des mots inappropriés.'));
            } else {
                resolve();
            }
        }, 2000);
    });
}


