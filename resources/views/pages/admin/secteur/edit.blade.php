@extends('layout.layout') 
@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content container-fluid">
        <!-- En-tête principale -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="font-weight-bold text-dark text-center">Modifier le Secteur</h1>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <form action="{{ route('secteur.update', $secteur->id) }}" method="POST" class="card shadow-sm p-4">
                    @csrf
                    @method('PUT')

                    <!-- Gestion des erreurs -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Champ Nom -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label font-weight-bold">Nom du Secteur</label>
                        <input type="text" name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               value="{{ old('name', $secteur->name) }}" 
                               placeholder="Entrez le nom" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champ Description -->
                    <div class="form-group mb-4">
                        <label for="description" class="form-label font-weight-bold">Description</label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  rows="4" 
                                  placeholder="Entrez une description">{{ old('description', $secteur->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-lg" aria-pressed="true">
                            <i class="feather icon-save mr-2"></i> Mettre à jour
                        </button>
                        <a href="{{ route('secteur.index') }}" 
                           class="btn btn-danger btn-lg" 
                           aria-pressed="false" 
                           onclick="return confirm('Voulez-vous vraiment annuler les modifications ?')">
                            <i class="feather icon-x-circle mr-2"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
