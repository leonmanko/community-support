// Sélection des éléments du DOM
const navLinks = document.querySelectorAll('nav li a');
const aboutSection = document.querySelector('.about-section');
const teamMembersContainer = document.getElementById('team-members-container');
const teamMemberModal = document.getElementById('team-member-modal');
const closeModalButton = document.getElementById('close-modal-button');

// Gestion de l'affichage du menu de navigation
navLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        const targetSection = document.querySelector(event.target.getAttribute('href'));
        targetSection.scrollIntoView({ behavior: 'smooth' });
    });
});

// Chargement des informations sur l'équipe
fetch('team-members.json')
    .then(response => response.json())
    .then(teamMembers => {
        teamMembers.forEach(member => {
            createTeamMemberCard(member);
        });
    })
    .catch(error => {
        console.error('Erreur lors du chargement des informations sur l\'équipe :', error);
    });

// Fonction de création de cartes de membres de l'équipe
function createTeamMemberCard(member) {
    const cardElement = document.createElement('div');
    cardElement.classList.add('team-member-card');
    cardElement.innerHTML = `
        <img src="${member.image}" alt="${member.name}">
        <h3>${member.name}</h3>
        <p>${member.role}</p>
        <button class="view-profile-button">Voir le profil</button>
    `;

    cardElement.querySelector('.view-profile-button').addEventListener('click', () => {
        showTeamMemberModal(member);
    });

    teamMembersContainer.appendChild(cardElement);
}

// Fonction d'affichage du modal de profil de membre de l'équipe
function showTeamMemberModal(member) {
    const modalContent = teamMemberModal.querySelector('.modal-content');
    modalContent.innerHTML = `
        <span class="close-button">&times;</span>
        <img src="${member.image}" alt="${member.name}">
        <h2>${member.name}</h2>
        <p>${member.role}</p>
        <p>${member.bio}</p>
    `;

    teamMemberModal.style.display = 'block';

    const closeButton = modalContent.querySelector('.close-button');
    closeButton.addEventListener('click', () => {
        teamMemberModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target == teamMemberModal) {
            teamMemberModal.style.display = 'none';
        }
    });
}


