// Sélectionner tous les boutons "En savoir plus"
const moreInfoButtons = document.querySelectorAll('.service .btn');

// Ajouter un écouteur d'événement sur chaque bouton
moreInfoButtons.forEach(button => {
  button.addEventListener('click', showMoreInfo);
});

function showMoreInfo(event) {
  // Récupérer l'élément parent du bouton cliqué (la section de service)
  const service = event.target.closest('.service');

  // Afficher un modal avec plus d'informations sur le service
  showModal(service);
}

function showModal(service) {
  // Créer le modal
  const modal = document.createElement('div');
  modal.classList.add('modal');

  // Ajouter le contenu du modal
  const modalContent = document.createElement('div');
  modalContent.classList.add('modal-content');

  const title = document.createElement('h2');
  title.textContent = service.querySelector('h2').textContent;

  const description = document.createElement('p');
  description.textContent = service.querySelector('p').textContent;

  const closeButton = document.createElement('button');
  closeButton.classList.add('close-button');
  closeButton.textContent = 'Fermer';
  closeButton.addEventListener('click', () => {
    modal.remove();
  });

  modalContent.appendChild(title);
  modalContent.appendChild(description);
  modalContent.appendChild(closeButton);
  modal.appendChild(modalContent);

  // Ajouter le modal au document
  document.body.appendChild(modal);
}



