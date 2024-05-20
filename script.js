// Sélection des éléments du DOM
const navLinks = document.querySelectorAll('nav li a');
const searchInput = document.getElementById('search-input');
const searchButton = document.getElementById('search-button');
const postContainer = document.getElementById('post-container');
const createPostButton = document.getElementById('create-post-button');
const postModal = document.getElementById('post-modal');
const postForm = document.getElementById('post-form');
const closeModalButton = document.getElementById('close-modal-button');

// Gestion de l'affichage du menu de navigation
navLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        const targetSection = document.querySelector(event.target.getAttribute('href'));
        targetSection.scrollIntoView({ behavior: 'smooth' });
    });
});

// Gestion de la recherche
searchButton.addEventListener('click', () => {
    const searchTerm = searchInput.value.toLowerCase();
    const posts = document.querySelectorAll('.post');
    posts.forEach(post => {
        const postTitle = post.querySelector('h3').textContent.toLowerCase();
        if (postTitle.includes(searchTerm)) {
            post.style.display = 'block';
        } else {
            post.style.display = 'none';
        }
    });
});

// Gestion de la création de posts
createPostButton.addEventListener('click', () => {
    postModal.style.display = 'block';
});

postForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const postTitle = document.getElementById('post-title').value;
    const postContent = document.getElementById('post-content').value;
    createPost(postTitle, postContent);
    postModal.style.display = 'none';
    postForm.reset();
});

closeModalButton.addEventListener('click', () => {
    postModal.style.display = 'none';
});

// Fonction de création de posts
function createPost(title, content) {
    const postElement = document.createElement('div');
    postElement.classList.add('post');
    postElement.innerHTML = `
        <h3>${title}</h3>
        <p>${content}</p>
        <div class="post-actions">
            <button class="like-button">J'aime</button>
            <button class="comment-button">Commenter</button>
        </div>
    `;
    postContainer.appendChild(postElement);
}


