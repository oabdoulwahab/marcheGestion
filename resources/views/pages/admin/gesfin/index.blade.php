@extends('layout.layout')

@section('title', 'Gestion Market || Gestion des finances')

@section('content')
<section class="pcoded-main-container">
    <div class="col-xl-12">
        <h2 class="mt-4">Gestion des finances</h2>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">Ajouter une dépense</button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addCotisationModal">Ajouter une cotisation</button>
            </div>
        </div>
        <hr>
    </div>

    <!-- Fenêtre modale pour ajouter une cotisation -->
    @include('pages.admin.gesfin.cotisation')

     <!-- Fenêtre modale pour ajouter une paiement -->
     @include('pages.admin.gesfin.paiement')

       <!-- Fenêtre modale pour ajouter une achat_vente -->
       @include('pages.admin.gesfin.achat_vente')

    <!-- Statistiques et Transactions Récentes -->
    <div class="container my-5">
        <h1 class="fs-2 fw-bold text-dark">Gestion des Finances</h1>
        <div class="table-responsive">
            <div class="row">
                @forelse ($cotisations as $cotisation)
                  
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card shadow-sm p-3 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-background mr-3">
                                        <i class="fas fa-store fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 font-weight-bold text-dark">{{ $cotisation->date_debut }}</h4>
                                        <p class="text-muted mb-0">{{ $cotisation->marchants_count }} Adhérants</p>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <button class="btn btn-outline-primary btn-block"><a href="{{ route('cotisation.show', $cotisation->id) }}" class="btn btn-succes">Voir les détails</a> </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">Aucun marchand trouvé pour ce secteur.</p>
                        </div>
                    @endforelse
            </div>
            {{-- Vous pouvez ajouter ici un tableau ou d'autres éléments si nécessaire --}}
        </div>
    
        <h1 class="fs-2 fw-bold text-dark">Gestion des Finances</h1>
        <div class="table-responsive">
            <div class="row">
                @forelse ($cotisations as $cotisation)
                  
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card shadow-sm p-3 h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-background mr-3">
                                        <i class="fas fa-store fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="h6 font-weight-bold text-dark">{{ $cotisation->date_debut }}</h4>
                                        <p class="text-muted mb-0">{{ $cotisation->marchants_count }} marchands</p>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <button class="btn btn-outline-primary btn-block"><a href="{{ route('marchant.show', $cotisation->id) }}" class="btn btn-succes">Voir les détails</a> </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">Aucun marchand trouvé pour ce secteur.</p>
                        </div>
                    @endforelse
            </div>
            {{-- Vous pouvez ajouter ici un tableau ou d'autres éléments si nécessaire --}}
        </div>
    </div>
</section>
@endsection