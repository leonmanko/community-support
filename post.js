// Données de test pour les réponses
const replies = [
  {
    id: 1,
    author: 'Jane Doe',
    content: 'Voici ma réponse à la discussion.'
  },
  {
    id: 2,
    author: 'Bob Smith',
    content: 'Je suis d\'accord avec ce qui a été dit.'
  },
  {
    id: 3,
    author: 'Alice Johnson',
    content: 'J\'ai une autre perspective à partager.'
  }
];

// Fonction pour afficher les réponses
function displayReplies() {
  const replyList = document.querySelector('.reply-list');
  replyList.innerHTML = '';

  replies.forEach(reply => {
    const replyCard = document.createElement('div');
    replyCard.classList.add('reply-card');

    const authorElement = document.createElement('div');
    authorElement.classList.add('reply-author');
    authorElement.textContent = reply.author;

    const contentElement = document.createElement('div');
    contentElement.classList.add('reply-content');
    contentElement.textContent = reply.content;

    replyCard.appendChild(authorElement);
    replyCard.appendChild(contentElement);
    replyList.appendChild(replyCard);
  });
}

// Fonction pour gérer l'envoi d'une nouvelle réponse
function handleNewReply(event) {
  event.preventDefault();

  const replyForm = document.querySelector('.reply-form');
  const replyTextarea = replyForm.querySelector('textarea');
  const newReplyContent = replyTextarea.value.trim();

  if (newReplyContent) {
    const newReply = {
      id: replies.length + 1,
      author: 'Vous',
      content: newReplyContent
    };

    replies.push(newReply);
    displayReplies();
    replyTextarea.value = '';
  }
}

// Ajouter un écouteur d'événement pour le formulaire de réponse
const replyForm = document.querySelector('.reply-form');
replyForm.addEventListener('submit', handleNewReply);

// Afficher les réponses initiales
displayReplies();


