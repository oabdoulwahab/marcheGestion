@extends('layout.layout')

@section('title', 'Gestion Market || Gestion des finances')

@section('content')
    <section class="pcoded-main-container">
        <div class="col-xl-12">
            <!-- Titre et boutons d'action -->
            <h2 class="mt-4">Gestion des finances</h2>
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Actions</h5>
                        <div>
                            <button class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#addFinanceModal">
                                <i class="fas fa-plus me-2"></i>Ajouter une finance
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <!-- Fenêtre modale pour ajouter une finance -->
        {{-- @include('pages.admin.gesfin.add_finance_modal') --}}

        <!-- Gestion des finances -->
        <div class="container my-5">
            <h1 class="fs-2 fw-bold text-dark mb-4">Gestion des finances</h1>

            <!-- Filtres par type -->
            <div class="mb-4">
                <button onclick="filterFinances('all', this)" class="btn btn-outline-secondary filter-button active">
                    <i class="fas fa-list me-2"></i>Tous
                </button>
                <button onclick="filterFinances('vente', this)" class="btn btn-outline-secondary filter-button">
                    <i class="fas fa-tag me-2"></i>Ventes
                </button>
                <button onclick="filterFinances('achat', this)" class="btn btn-outline-secondary filter-button">
                    <i class="fas fa-shopping-cart me-2"></i>Achats
                </button>
            </div>

            <!-- Champ de recherche -->
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une finance...">
                </div>
            </div>

            <!-- Tableau des finances -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="financeTable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Montant</th>
                                            <th>Date de création</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($finance as $finance)
                                            <tr data-type="">
                                                <td>{{ $loop->iteration }}</td>
                                                {{-- <td>{{ $finance->name }}</td> --}}
                                                {{-- <td>{{ ucfirst($finance->type) }}</td> --}}
                                                {{-- <td>{{ number_format($finance->amount, 2) }} €</td> --}}
                                                {{-- <td>{{ $finance->created_at->format('d/m/Y') }}</td> --}}
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- <a href="{{ route('finance.show', $finance->id) }}" --}}
                                                            class="btn btn-primary btn-sm me-2" title="Voir">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form action=""
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Supprimer"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette finance ?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <div class="alert alert-info" role="alert">
                                                        Aucune finance trouvée.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Styles supplémentaires -->
    <style>
        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .filter-button.active {
            background-color: #007bff;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>

    <!-- Scripts -->
    <script>
        // Filtrage par type
        function filterFinances(type, button) {
            // Activer le bouton sélectionné
            document.querySelectorAll('.filter-button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Filtrer les lignes du tableau
            const tableRows = document.querySelectorAll('#financeTable tbody tr');
            tableRows.forEach(row => {
                const rowType = row.getAttribute('data-type');
                if (type === 'all' || rowType === type) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Recherche dynamique
        document.getElementById('searchInput').addEventListener('input', function () {
            const searchText = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('#financeTable tbody tr');

            tableRows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (name.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection