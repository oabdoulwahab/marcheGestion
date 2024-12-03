document.addEventListener('DOMContentLoaded', function () {
    const sectorContainer = document.getElementById('sectors');
    
    // Vérifiez si l'attribut data-sectors existe
    if (!sectorContainer.dataset.sectors) {
        console.error("Aucun secteur trouvé dans 'data-sectors'.");
        return;
    }

    // Récupérer les données JSON des secteurs
    const sectors = JSON.parse(sectorContainer.dataset.sectors);

    // Afficher les cartes des secteurs
    sectors.forEach(secteur => {
        const secteurCard = `
            <div class="col-md-4 mb-4">
                <div class="border p-3 rounded-lg d-flex align-items-center">
                    <div class="mr-3"><i class="fas fa-building text-muted"></i></div>
                    <div>
                        <p class="font-weight-bold text-dark mb-0">${secteur.name}</p>
                        <p class="text-muted small">${secteur.marchants_count} marchands</p>
                    </div>
                </div>
            </div>
        `;
        sectorContainer.innerHTML += secteurCard;
    });
});
