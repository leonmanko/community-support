// Récupération des éléments du formulaire
const registerForm = document.getElementById('register-form');
const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm-password');

// Fonction de validation du formulaire
function validateForm() {
    let isValid = true;

    // Validation du nom d'utilisateur
    if (usernameInput.value.trim() === '') {
        showError(usernameInput, 'Veuillez entrer un nom d\'utilisateur.');
        isValid = false;
    } else {
        clearError(usernameInput);
    }

    // Validation de l'adresse e-mail
    if (emailInput.value.trim() === '') {
        showError(emailInput, 'Veuillez entrer une adresse e-mail.');
        isValid = false;
    } else if (!isValidEmail(emailInput.value.trim())) {
        showError(emailInput, 'Veuillez entrer une adresse e-mail valide.');
        isValid = false;
    } else {
        clearError(emailInput);
    }

    // Validation du mot de passe
    if (passwordInput.value.trim() === '') {
        showError(passwordInput, 'Veuillez entrer un mot de passe.');
        isValid = false;
    } else if (passwordInput.value.trim().length < 8) {
        showError(passwordInput, 'Le mot de passe doit contenir au moins 8 caractères.');
        isValid = false;
    } else {
        clearError(passwordInput);
    }

    // Validation de la confirmation du mot de passe
    if (confirmPasswordInput.value.trim() === '') {
        showError(confirmPasswordInput, 'Veuillez confirmer le mot de passe.');
        isValid = false;
    } else if (confirmPasswordInput.value.trim() !== passwordInput.value.trim()) {
        showError(confirmPasswordInput, 'Les mots de passe ne correspondent pas.');
        isValid = false;
    } else {
        clearError(confirmPasswordInput);
    }

    return isValid;
}

// Fonction d'affichage des erreurs
function showError(input, message) {
    const formGroup = input.parentElement;
    formGroup.classList.add('error');
    const errorMessage = formGroup.querySelector('.error-message');
    errorMessage.textContent = message;
}

// Fonction de suppression des erreurs
function clearError(input) {
    const formGroup = input.parentElement;
    formGroup.classList.remove('error');
    const errorMessage = formGroup.querySelector('.error-message');
    errorMessage.textContent = '';
}

// Fonction de validation de l'adresse e-mail
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Gestion de l'événement de soumission du formulaire
registerForm.addEventListener('submit', (event) => {
    event.preventDefault();

    if (validateForm()) {
        // Ici, vous pouvez ajouter la logique d'envoi des données du formulaire au serveur
        console.log('Formulaire valide, prêt à être envoyé au serveur.');
    }
});



