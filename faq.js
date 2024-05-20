// Sélectionner tous les éléments de la FAQ
const faqItems = document.querySelectorAll('.faq-item');

// Ajouter un écouteur d'événements sur chaque élément de la FAQ
faqItems.forEach(item => {
    item.addEventListener('click', toggleFaqItem);
});

// Fonction pour afficher/masquer le contenu de la FAQ
function toggleFaqItem() {
    this.classList.toggle('active');

    const content = this.querySelector('p');
    if (content.style.display === 'none') {
        content.style.display = 'block';
    } else {
        content.style.display = 'none';
    }
}


