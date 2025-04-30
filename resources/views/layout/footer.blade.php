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
    function setActiveButton(activeButton) {
        const buttons = document.querySelectorAll('.filter-button');
        buttons.forEach(button => button.classList.remove('active'));
        activeButton.classList.add('active');
    }

    function filterFinances(type, button) {
        setActiveButton(button);

        const tableRows = document.querySelectorAll('#marchantTable tbody tr');

        tableRows.forEach(row => {
            const rowType = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // 3ème colonne = Type
            if (type === 'all' || rowType === type) {
                row.style.display = ''; // Afficher la ligne
            } else {
                row.style.display = 'none'; // Masquer la ligne
            }
        });
    }

    function filterCotisationsByYear() {
        const selectedYear = document.getElementById('yearFilter').value;
        const cotisationItems = document.querySelectorAll('.cotisation-item');

        cotisationItems.forEach(item => {
            const itemYear = item.getAttribute('data-year');
            if (selectedYear === 'all' || itemYear === selectedYear) {
                item.style.display = 'block'; // Affiche les éléments correspondant
            } else {
                item.style.display = 'none'; // Masque les éléments non correspondants
            }
        });
    }

    
        // Fonction pour filtrer les adhérents par statut de paiement
        function filterAdherents(status) {
            const rows = document.querySelectorAll('#marchantTable tbody tr');

            rows.forEach(row => {
                const paymentStatus = row.getAttribute('data-payment-status');
                if (status === 'all' || paymentStatus === status) {
                    row.style.display = ''; // Afficher la ligne
                } else {
                    row.style.display = 'none'; // Masquer la ligne
                }
            });

            // Mettre à jour l'état actif des boutons de filtrage
            document.querySelectorAll('.filter-button').forEach(button => {
                button.classList.remove('active');
            });
            document.querySelector(`button[onclick="filterAdherents('${status}')"]`).classList.add('active');
        }
</script>

