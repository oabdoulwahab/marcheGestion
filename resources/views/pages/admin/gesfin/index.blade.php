@extends('layout.layout')

@section('title', 'Gestion Market || Gestion des finances')

@section('content')
    <section class="pcoded-main-container">
        <div class="col-xl-12">
            <!-- Titre et boutons d'action -->
            <h2 class="mt-4">Gestion des finances</h2>
            <div class="">
                <div class="card-header">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                        Ajouter une dépense
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCotisationModal">
                        Ajouter une cotisation
                    </button>
                </div>
            </div>
            <hr>
        </div>

        <!-- Fenêtres modales -->
        @include('pages.admin.gesfin.cotisation')
        @include('pages.admin.gesfin.paiement')
        @include('pages.admin.gesfin.achat_vente')

        <div class="container my-5">
            <h1 class="fs-2 fw-bold text-dark mb-4">Gestion des cotisations</h1>
            <div class="mb-4">
                <label for="yearFilter" class="form-label">Filtrer par année :</label>
                <select id="yearFilter" class="btn btn-outline-secondary " onchange="filterCotisationsByYear()">
                    <option value="all">Toutes les années</option>
                    @foreach ($cotisations->pluck('date_debut')->map(fn($date) => \Carbon\Carbon::parse($date)->year)->unique() as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row" id="cotisationsContainer">
                @forelse ($cotisations as $cotisation)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 cotisation-item"
                        data-year="{{ \Carbon\Carbon::parse($cotisation->date_debut)->year }}">
                        <div class="card shadow-sm h-100 hover-scale">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-background me-3">
                                        <i class="fas fa-coins fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 fw-bold text-dark">{{ $cotisation->name }}</h4>
                                        <p class="text-muted mb-0">{{ $cotisation->marchants_count }} Adhérents</p>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('admin.cotisation.show', $cotisation->id) }}"
                                        class="btn btn-outline-primary btn-block w-100">
                                        <i class="fas fa-eye me-2"></i>Voir les détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            Aucune cotisation trouvée.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('admin.finance.index') }}" class="btn btn-success">
                    <i class="fas fa-arrow-right me-2"></i>Voir plus de cotisations
                </a>
            </div>
        </div>

        <!-- Gestion des finances -->
        <div class="container my-5">
            <h1 class="fs-2 fw-bold text-dark mb-4">Gestion des finances</h1>
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
                    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un adhérent...">
                </div>
            </div>

            <!-- Tableau des adhérents -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="marchantTable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($finances as $finance)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $finance->name }}</td>
                                                <td>{{ $finance->type }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('finance.show', $finance->id) }}"
                                                            class="btn btn-primary btn-sm mr-2" title="Voir">
                                                            <i class="feather icon-eye"></i>
                                                        </a>
                                                        <form action="" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Supprimer de la cotisation"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir retirer ?')">
                                                                <i class="feather icon-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
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


@endsection
