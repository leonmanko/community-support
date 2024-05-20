// Sélection des éléments du DOM
const usernameElement = document.getElementById('username');
const emailElement = document.getElementById('email');
const bioElement = document.getElementById('bio');
const editProfileButton = document.getElementById('edit-profile');
const changePasswordButton = document.getElementById('change-password');

// Récupération des informations de l'utilisateur depuis le stockage local
const user = JSON.parse(localStorage.getItem('user')) || {
  username: 'Utilisateur',
  email: 'utilisateur@example.com',
  bio: 'Biographie de l\'utilisateur'
};

// Affichage des informations de l'utilisateur
usernameElement.textContent = user.username;
emailElement.textContent = user.email;
bioElement.textContent = user.bio;

// Gestion de l'événement de modification du profil
editProfileButton.addEventListener('click', () => {
  // Affichage d'un formulaire de modification du profil
  showProfileEditForm();
});

// Gestion de l'événement de changement de mot de passe
changePasswordButton.addEventListener('click', () => {
  // Affichage d'un formulaire de changement de mot de passe
  showPasswordChangeForm();
});

// Fonction pour afficher le formulaire de modification du profil
function showProfileEditForm() {
  // Créer et afficher le formulaire de modification du profil
  const profileEditForm = document.createElement('div');
  profileEditForm.classList.add('profile-edit-form');
  profileEditForm.innerHTML = `
    <h2>Modifier le profil</h2>
    <input type="text" id="new-username" placeholder="Nouveau nom d'utilisateur" value="${user.username}">
    <input type="email" id="new-email" placeholder="Nouvelle adresse e-mail" value="${user.email}">
    <textarea id="new-bio" placeholder="Nouvelle biographie">${user.bio}</textarea>
    <div class="form-actions">
      <button id="save-profile" class="btn">Enregistrer</button>
      <button id="cancel-profile-edit" class="btn">Annuler</button>
    </div>
  `;
  document.body.appendChild(profileEditForm);

  // Gestion de l'événement de sauvegarde du profil
  const saveProfileButton = profileEditForm.querySelector('#save-profile');
  saveProfileButton.addEventListener('click', saveProfile);

  // Gestion de l'événement d'annulation de la modification du profil
  const cancelProfileEditButton = profileEditForm.querySelector('#cancel-profile-edit');
  cancelProfileEditButton.addEventListener('click', () => {
    profileEditForm.remove();
  });
}

// Fonction pour afficher le formulaire de changement de mot de passe
function showPasswordChangeForm() {
  // Créer et afficher le formulaire de changement de mot de passe
  const passwordChangeForm = document.createElement('div');
  passwordChangeForm.classList.add('password-change-form');
  passwordChangeForm.innerHTML = `
    <h2>Changer le mot de passe</h2>
    <input type="password" id="current-password" placeholder="Mot de passe actuel">
    <input type="password" id="new-password" placeholder="Nouveau mot de passe">
    <input type="password" id="confirm-password" placeholder="Confirmer le nouveau mot de passe">
    <div class="form-actions">
      <button id="save-password" class="btn">Enregistrer</button>
      <button id="cancel-password-change" class="btn">Annuler</button>
    </div>
  `;
  document.body.appendChild(passwordChangeForm);

  // Gestion de l'événement de changement de mot de passe
  const savePasswordButton = passwordChangeForm.querySelector('#save-password');
  savePasswordButton.addEventListener('click', changePassword);

  // Fonction pour afficher le formulaire de changement de mot de passe
  function showPasswordChangeForm() {
    // Créer et afficher le formulaire de changement de mot de passe
    const passwordChangeForm = document.createElement('div');
    passwordChangeForm.classList.add('password-change-form');
    passwordChangeForm.innerHTML = `
      <h2>Changer le mot de passe</h2>
      <input type="password" id="current-password" placeholder="Mot de passe actuel">
      <input type="password" id="new-password" placeholder="Nouveau mot de passe">
      <input type="password" id="confirm-password" placeholder="Confirmer le nouveau mot de passe">
      <div class="form-actions">
        <button id="save-password" class="btn">Enregistrer</button>
        <button id="cancel-password-change" class="btn">Annuler</button>
      </div>
    `;
    document.body.appendChild(passwordChangeForm);
  
    // Gestion de l'événement de changement de mot de passe
    const savePasswordButton = passwordChangeForm.querySelector('#save-password');
    savePasswordButton.addEventListener('click', changePassword);
  
    // Gestion de l'événement d'annulation du changement de mot de passe
    const cancelPasswordChangeButton = passwordChangeForm.querySelector('#cancel-password-change');
    cancelPasswordChangeButton.addEventListener('click', () => {
      passwordChangeForm.remove();
    });
  }
}
