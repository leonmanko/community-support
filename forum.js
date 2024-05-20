// Récupération des éléments du DOM
const newPostForm = document.getElementById('new-post-form');
const postTitleInput = document.getElementById('post-title');
const postContentInput = document.getElementById('post-content');
const forumContainer = document.querySelector('.forum-container');

// Tableau pour stocker les sujets de discussion
let posts = [];

// Fonction pour créer un nouveau sujet de discussion
function createPostElement(post) {
    const postElement = document.createElement('div');
    postElement.classList.add('forum-post');

    const postHeader = document.createElement('div');
    postHeader.classList.add('post-header');

    const postTitle = document.createElement('h3');
    postTitle.textContent = post.title;

    const postAuthor = document.createElement('p');
    postAuthor.textContent = `Posté par ${post.author} le ${post.date}`;

    const postContent = document.createElement('div');
    postContent.classList.add('post-content');

    const postContentText = document.createElement('p');
    postContentText.textContent = post.content;

    const postActions = document.createElement('div');
    postActions.classList.add('post-actions');

    const replyButton = document.createElement('a');
    replyButton.classList.add('reply-btn');
    replyButton.href = '#';
    replyButton.textContent = 'Répondre';

    const likeButton = document.createElement('a');
    likeButton.classList.add('like-btn');
    likeButton.href = '#';
    likeButton.textContent = 'J\'aime';

    postHeader.appendChild(postTitle);
    postHeader.appendChild(postAuthor);
    postContent.appendChild(postContentText);
    postActions.appendChild(replyButton);
    postActions.appendChild(likeButton);

    postElement.appendChild(postHeader);
    postElement.appendChild(postContent);
    postElement.appendChild(postActions);

    return postElement;
}

// Fonction pour ajouter un nouveau sujet de discussion
function addNewPost(event) {
    event.preventDefault();

    const postTitle = postTitleInput.value.trim();
    const postContent = postContentInput.value.trim();

    if (postTitle && postContent) {
        const newPost = {
            title: postTitle,
            content: postContent,
            author: 'Utilisateur Anonyme',
            date: new Date().toLocaleDateString()
        };

        posts.push(newPost);
        const postElement = createPostElement(newPost);
        forumContainer.appendChild(postElement);

        postTitleInput.value = '';
        postContentInput.value = '';
    }
}

// Ajout de l'écouteur d'événement pour le formulaire
newPostForm.addEventListener('submit', addNewPost);

// Affichage initial des sujets de discussion
posts.forEach(post => {
    const postElement = createPostElement(post);
    forumContainer.appendChild(postElement);
});


