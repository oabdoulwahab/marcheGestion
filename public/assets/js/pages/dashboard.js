const markets = [
    {
        id: 1,
        name: 'Marché Central',
        location: 'Centre-ville',
        type: 'Alimentaire',
        status: 'Actif',
        revenue: '€12,000'
    },
    {
        id: 2,
        name: 'Marché aux Fleurs',
        location: 'Quartier Sud',
        type: 'Floral',
        status: 'Actif',
        revenue: '€8,500'
    },
    {
        id: 3,
        name: 'Marché Artisanal',
        location: 'Vieille Ville',
        type: 'Artisanat',
        status: 'En préparation',
        revenue: '€0'
    }
];

const secteurs = [
    { name: 'Alimentaire', count: 12 },
    { name: 'Artisanat', count: 8 },
    { name: 'Textile', count: 5 },
    { name: 'Services', count: 3 },
    { name: 'Floral', count: 2 },
    { name: 'Autres', count: 4 }
];

const marketContainer = document.getElementById('markets');
const sectorContainer = document.getElementById('secteurs');

markets.forEach(market => {
    const marketCard = `
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm p-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-background mr-3"><i class="fas fa-store"></i></div>
                    <div>
                        <h3 class="h6 font-weight-bold text-dark">${market.name}</h3>
                        <p class="text-muted">${market.location}</p>
                    </div>
                </div>
                <div class="mb-2 d-flex justify-content-between">
                    <span class="text-muted">Type</span>
                    <span class="font-weight-medium">${market.type}</span>
                </div>
                <div class="mb-2 d-flex justify-content-between">
                    <span class="text-muted">Status</span>
                    <span class="${market.status === 'Actif' ? 'status-actif' : 'status-preparation'}">${market.status}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Revenue</span>
                    <span class="font-weight-medium">${market.revenue}</span>
                </div>
                <div class="mt-4">
                    <button class="btn btn-outline-primary btn-block">Voir les détails</button>
                </div>
            </div>
        </div>
    `;
    marketContainer.innerHTML += marketCard;
});

secteurs.forEach(secteur => {
    const secteurCard = `
        <div class="col-md-4 mb-4">
            <div class="border p-3 rounded-lg d-flex align-items-center">
                <div class="mr-3"><i class="fas fa-building text-muted"></i></div>
                <div>
                    <p class="font-weight-bold text-dark mb-0">${secteur.name}</p>
                    <p class="text-muted small">${secteur.count} marchands</p>
                </div>
            </div>
        </div>
    `;
    sectorContainer.innerHTML += secteurCard;
});


//Gestion financiére 

const expenseForm = document.getElementById('expense-form');
const expenseList = document.getElementById('expense-list');
const expenseChartCtx = document.getElementById('expenseChart').getContext('2d');

let finances = [];
let expenseChart;

expenseForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const expenseName = document.getElementById('expense-name').value;
    const expenseAmount = parseFloat(document.getElementById('expense-amount').value);

    // Ajouter la dépense à la liste
    finances.push({ name: expenseName, amount: expenseAmount });
    updateExpenseList();
    updateChart();
    expenseForm.reset();
});

function updateExpenseList() {
    expenseList.innerHTML = '';
    finances.forEach(expense => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.textContent = `${expense.name}: ${expense.amount} €`;
        expenseList.appendChild(listItem);
    });
}

function updateChart() {
    const labels = finances.map(expense => expense.name);
    const data = finances.map(expense => expense.amount);

    if (expenseChart) {
        expenseChart.destroy();
    }

    expenseChart = new Chart(expenseChartCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'D épenses',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

//
 // Fonction pour supprimer une dépense
        function deleteExpense(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette dépense ?')) {
                $.ajax({
                    url: '/finance/' + id,
                    type: 'DELETE',
                    success: function(result) {
                        location.reload(); // Recharger la page pour voir les changements
                    }
                });
            }
        }

        // Soumettre le formulaire pour ajouter une dépense
        $('#expense-form').on('submit', function(event) {
            event.preventDefault();

            const name = $('#expense-name').val();
            const amount = $('#expense-amount').val();

            $.ajax({
                url: '/finance',
                type: 'POST',
                data: {
                    name: name,
                    amount: amount,
                    _token: '{{ csrf_token() }}' // Ajoutez le token CSRF pour la sécurité
                },
                success: function(result) {
                    location.reload(); // Recharger la page pour voir les changements
                },
                error: function(xhr) {
                    alert('Erreur lors de l\'ajout de la dépense : ' + xhr.responseText);
                }
            });
        });

        //finance

        const financialData = [
            { icon: 'fas fa-arrow-up', label: 'Revenus Mensuels', amount: '€45,000', color: 'green', percentage: '+12%' },
            { icon: 'fas fa-arrow-down', label: 'Dépenses Mensuelles', amount: '€32,000', color: 'red', percentage: '-8%' },
            { icon: 'fas fa-dollar-sign', label: 'Bénéfice Net', amount: '€13,000', color: 'blue', percentage: '+15%' },
          ];
      
          const expenseBreakdown = [
            { category: 'Personnel', amount: '€15,000', percentage: '47%' },
            { category: 'Maintenance', amount: '€8,000', percentage: '25%' },
            { category: 'Marketing', amount: '€5,000', percentage: '16%' },
            { category: 'Autres', amount: '€4,000', percentage: '12%' },
          ];
      
          const transactions = [
            { date: '2024-03-15', description: 'Paiement Location', type: 'Crédit', amount: '€2,500', status: 'Complété' },
            { date: '2024-03-14', description: 'Facture Maintenance', type: 'Débit', amount: '€800', status: 'En attente' },
            { date: '2024-03-13', description: 'Cotisation Mensuelle', type: 'Crédit', amount: '€1,200', status: 'Complété' },
            { date: '2024-03-12', description: 'Achat Fournitures', type: 'Débit', amount: '€350', status: 'Complété' },
          ];
      
          const financialCardsContainer = document.getElementById("financial-cards");
          const expenseBreakdownContainer = document.getElementById("expense-breakdown");
          const transactionTableBody = document.getElementById("transaction-table");
      
          // Render Financial Cards
          financialData.forEach(data => {
            financialCardsContainer.innerHTML += `
              <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                <div class="p-2 rounded-circle text-white bg-${data.color}">
                  <i class="${data.icon}"></i>
                </div>
                <div>
                  <p class="mb-0 text-secondary">${data.label}</p>
                  <p class="fs-5 fw-semibold">${data.amount}</p>
                  <p class="mb-0 text-${data.color}">${data.percentage}</p>
                </div>
              </div>
            `;
          });
      
          // Render Expense Breakdown
          expenseBreakdown.forEach(item => {
            expenseBreakdownContainer.innerHTML += `
              <div class="d-flex justify-content-between">
                <span class="text-secondary">${item.category}</span>
                <div class="d-flex gap-3">
                  <span class="fw-medium">${item.amount}</span>
                  <span class="text-secondary">(${item.percentage})</span>
                </div>
              </div>
            `;
          });
      
          // Render Transactions Table
          transactions.forEach(transaction => {
            transactionTableBody.innerHTML += `
              <tr>
                <td>${transaction.date}</td>
                <td>${transaction.description}</td>
                <td><span class="badge bg-${transaction.type === 'Crédit' ? 'success' : 'danger'}">${transaction.type}</span></td>
                <td>${transaction.amount}</td>
                <td><span class="badge bg-${transaction.status === 'Complété' ? 'primary' : 'warning'}">${transaction.status}</span></td>
              </tr>
            `;
          });


  $('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Bouton qui déclenche la modale
    var id = button.data('id');
    var name = button.data('name');
    var amount = button.data('amount');

    var modal = $(this);
    modal.find('#edit-expense-id').val(id);
    modal.find('#edit-expense-name').val(name);
    modal.find('#edit-expense-amount').val(amount);

    // Modifier l'action du formulaire avec l'ID de l'enregistrement
    modal.find('#edit-expense-form').attr('action', `/finance/${id}`);
  });

  // Remplir le formulaire d'édition avec les données de la dépense
  function editFinance(id) {
    // Récupérer les données de la dépense en fonction de l'ID
    var finance = json($finances); // Convertir la collection en JSON pour l'utiliser en JS
    var selectedFinance = finance.find(f => f.id === id);

    // Remplir le formulaire avec les données de la dépense
    document.getElementById('edit-expense-name').value = selectedFinance.name;
    document.getElementById('edit-expense-description').value = selectedFinance.description;
    document.getElementById('edit-expense-type').value = selectedFinance.type;
    document.getElementById('edit-expense-amount').value = selectedFinance.amount;
    document.getElementById('edit-expense-status').value = selectedFinance.status;

    // Modifier l'action du formulaire pour inclure l'ID de la dépense
    var formAction = "{{ route('finance.update', ':id') }}".replace(':id', selectedFinance.id);
    document.getElementById('edit-expense-form').action = formAction;
}