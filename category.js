// script.js

// Données des catégories (à remplacer par une requête API)
const categories = [
  { id: 1, name: 'Informatique' },
  { id: 2, name: 'Santé' },
  { id: 3, name: 'Éducation' },
  { id: 4, name: 'Loisirs' },
  { id: 5, name: 'Finances' },
  { id: 6, name: 'Jardinage' },
];

// Fonction pour générer les cartes de catégories
function generateCategoryCards() {
  const categoryList = document.querySelector('.category-list');

  categories.forEach(category => {
    const card = document.createElement('div');
    card.classList.add('category-card');
    card.dataset.categoryId = category.id;
    card.textContent = category.name;
    card.addEventListener('click', () => {
      // Logique pour afficher les discussions de la catégorie sélectionnée
      console.log(`Catégorie sélectionnée : ${category.name}`);
      // Ici, vous pouvez ajouter le code pour charger les discussions de la catégorie sélectionnée
      // et les afficher dans une section dédiée de la page
    });

    categoryList.appendChild(card);
  });
}

// Appel de la fonction pour générer les cartes de catégories
generateCategoryCards();


