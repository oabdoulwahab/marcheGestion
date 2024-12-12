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

// Préparez les labels (mois) et les données pour le graphique
// Utilisation de @json() pour passer les données Laravel au JavaScript
var months = JSON.parse('@json($data->pluck("months"))');
var totals = JSON.parse('@json($data->pluck("totals"))');

// Vérifiez si l'élément HTML pour le graphique existe
var chartElement = document.getElementById('myChart');
if (chartElement) {
    var ctx = chartElement.getContext('2d');

    // Créez le graphique
    var myChart = new Chart(ctx, {
        type: 'bar', // Type de graphique : barres
        data: {
            labels: months.map(month => `Mois ${month}`), // Labels pour les mois
            datasets: [{
                label: 'Montant des contrats (en €)',
                data: totals, // Données pour les montants
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur de fond
                borderColor: 'rgba(75, 192, 192, 1)',       // Couleur de la bordure
                borderWidth: 1                              // Épaisseur de la bordure
            }]
        },
        options: {
            responsive: true, // Rendre le graphique responsive
            plugins: {
                legend: {
                    display: true,
                    position: 'top', // Position de la légende
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function (context) {
                            return `${context.dataset.label}: ${context.raw} €`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // Commencer l'axe Y à zéro
                    title: {
                        display: true,
                        text: 'Montant (en €)' // Titre pour l'axe Y
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Mois' // Titre pour l'axe X
                    }
                }
            }
        }
    });
} else {
    console.error('Élément graphique introuvable : myChart');
}

