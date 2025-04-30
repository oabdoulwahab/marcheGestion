@extends('layout.layout')

@section('title', 'Détails du Marchand')

@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content container-fluid">
        <!-- En-tête principale -->
        <div class="row mb-4">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-center">
                <h1 class="font-weight-bold text-dark mb-3 mb-md-0">
                    Détails du Marchand
                </h1>
                <a href="{{ route('marchant.show', $marchand->secteur->id) }}" class="btn btn-danger">
                    <i class="feather icon-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>

        <!-- Détails du Marchand -->
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ $marchand->name }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Adresse -->
                        <div class="mb-3">
                            <h6 class="text-muted font-weight-bold">Adresse</h6>
                            <p>{{ $marchand->address ?? 'Non renseignée' }}</p>
                        </div>

                        <!-- Téléphone -->
                        <div class="mb-3">
                            <h6 class="text-muted font-weight-bold">Téléphone</h6>
                            <p>{{ $marchand->phone ?? 'Non renseigné' }}</p>
                        </div>

                        <!-- Numéro d'espace -->
                        <div class="mb-3">
                            <h6 class="text-muted font-weight-bold">Numéro d'Espace</h6>
                            <p>{{ $marchand->espace->numero_space ?? 'Non renseigné' }}</p>
                        </div>

                        <!-- Secteur -->
                        <div class="mb-3">
                            <h6 class="text-muted font-weight-bold">Secteur</h6>
                            <p>{{ $marchand->secteur->name ?? 'Non renseigné' }}</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('marchant.edit', $marchand->id) }}" class="btn btn-success">
                            <i class="feather icon-edit mr-2"></i> Modifier
                        </a>
                        <form action="{{ route('marchant.destroy', $marchand->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce marchand ?')">
                                <i class="feather icon-trash-2 mr-2"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection