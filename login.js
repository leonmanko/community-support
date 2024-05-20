// Sélection des éléments du formulaire
const loginForm = document.getElementById('login-form');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const errorMessages = document.querySelectorAll('.error-message');

// Fonction de validation du formulaire
function validateForm() {
    let isValid = true;

    // Vérification de l'adresse e-mail
    if (!emailInput.value.trim()) {
        errorMessages[0].textContent = 'Veuillez saisir une adresse e-mail.';
        isValid = false;
    } else if (!isValidEmail(emailInput.value.trim())) {
        errorMessages[0].textContent = 'Veuillez saisir une adresse e-mail valide.';
        isValid = false;
    } else {
        errorMessages[0].textContent = '';
    }

    // Vérification du mot de passe
    if (!passwordInput.value.trim()) {
        errorMessages[1].textContent = 'Veuillez saisir un mot de passe.';
        isValid = false;
    } else {
        errorMessages[1].textContent = '';
    }

    return isValid;
}

// Fonction de vérification de l'adresse e-mail
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Gestion de la soumission du formulaire
loginForm.addEventListener('submit', (event) => {
    event.preventDefault();

    if (validateForm()) {
        // Envoi des données de connexion au serveur
        // (à remplacer par votre propre logique de connexion)
        console.log('Connexion réussie !');
    }
});


