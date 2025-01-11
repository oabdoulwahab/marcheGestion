function setActiveButton(activeButton) {
    const buttons = document.querySelectorAll('.filter-button');
    buttons.forEach(button => button.classList.remove('active'));
    activeButton.classList.add('active');
}

function filterFinances(type, button) {
    setActiveButton(button);
    // Reste du code de filtrage...
    
        const financeContainer = document.getElementById('finance-container');
        const financeCards = financeContainer.getElementsByClassName('col-lg-4');

        for (let card of financeCards) {
            const cardType = card.getAttribute('data-type');

            if (type === 'all' || cardType === type) {
                card.style.display = 'block'; // Afficher la carte
            } else {
                card.style.display = 'none'; // Masquer la carte
            }
        
    }
}