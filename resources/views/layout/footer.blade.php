<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>

<!-- Apex Chart -->
<script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>

<!-- Font Awesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Dashboard script -->
<script src="{{ asset('assets/js/pages/dashboard-cart.js') }}"></script>
<script src="{{ asset('assets/js/pages/secteur.js') }}"></script>

<!-- custom-chart js -->
<script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script>
<script src="{{ asset('assets/js/pages/chart-apex.js') }} "></script>

{{-- form js --}}
<script src="{{ asset('assets/js/pages/form.js') }}"></script>
{{-- Contenu du dashboard --}}
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pages/chart.js') }} "></script>

<!-- Ajout du script Bootstrap (assurez-vous que Bootstrap et jQuery sont inclus dans le projet) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Ajouter Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $('#marchantTable').DataTable();
    // });
</script>
<script>

var months = JSON.parse('@json($data->pluck("month"))');
var totals = JSON.parse('@json($data->pluck("total"))');

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


</script>