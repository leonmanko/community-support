
// Sélection des éléments du formulaire
const form = document.querySelector('.new-post-form');
const titleInput = document.getElementById('title');
const contentTextarea = document.getElementById('content');
const authorInput = document.getElementById('author');

// Écoute de l'événement de soumission du formulaire
form.addEventListener('submit', (event) => {
  event.preventDefault(); // Empêche le rechargement de la page

  // Récupération des valeurs des champs
  const title = titleInput.value.trim();
  const content = contentTextarea.value.trim();
  const author = authorInput.value.trim();

  // Validation des champs
  if (title === '' || content === '' || author === '') {
    alert('Veuillez remplir tous les champs du formulaire.');
    return;
  }

  // Création de l'objet de publication
  const newPost = {
    title,
    content,
    author,
    date: new Date().toLocaleString()
  };

  // Enregistrement de la publication dans le stockage local
  savePostToLocalStorage(newPost);

  // Réinitialisation du formulaire
  form.reset();

  // Redirection vers la page des publications
  window.location.href = 'post.html';
});

// Fonction pour enregistrer la publication dans le stockage local
function savePostToLocalStorage(post) {
  // Récupération des publications existantes depuis le stockage local
  let posts = JSON.parse(localStorage.getItem('posts')) || [];

  // Ajout de la nouvelle publication à la liste
  posts.push(post);

  // Enregistrement de la liste mise à jour dans le stockage local
  localStorage.setItem('posts', JSON.stringify(posts));
}


