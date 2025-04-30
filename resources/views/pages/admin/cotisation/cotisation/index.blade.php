@extends('layout.layout')

@section('title', 'Gestion Market || Toutes les cotisations')

@section('content')
<section class="pcoded-main-container">
    <div class="col-xl-12">
        <h2 class="mt-4">Toutes les cotisations</h2>
        <div class="">
            <div class="card-header">
                <a href="{{ route('finance.index') }}" class="btn btn-danger">
                    <i class="feather icon-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>
        <hr>
    </div>

    <!-- Liste de toutes les cotisations -->
    <div class="container my-5">
        <h1 class="fs-2 fw-bold text-dark">Toutes les cotisations</h1>
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
                                    <h4 class="h6 font-weight-bold text-dark">{{ $cotisation->name }}</h4>
                                    <p class="text-muted mb-0">{{ $cotisation->marchants_count }} Adhérents</p>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <a href="{{ route('cotisation.show', $cotisation->id) }}" class="btn btn-outline-primary btn-block">Voir les détails</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Aucune cotisation trouvée.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection