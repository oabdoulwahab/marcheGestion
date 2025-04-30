@extends('layout.layout')

@section('title', 'Modifier le Marchand')

@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content container-fluid">
        <!-- En-tête principale -->
        <div class="row mb-4">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-center">
                <h1 class="font-weight-bold text-dark mb-3 mb-md-0">Modifier le Marchand</h1>
                <a href="{{ route('secteur.show', $marchant->secteur->id) }}" class="btn btn-danger">
                    <i class="feather icon-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>

        <!-- Formulaire d'édition -->
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('marchant.update', $marchant->id) }}" method="POST" class="p-4">
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
                                <label for="name" class="font-weight-bold">Nom et Prénom</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $marchant->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Champ Adresse -->
                            <div class="form-group mb-3">
                                <label for="address" class="font-weight-bold">Adresse</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ old('address', $marchant->address) }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Champ Téléphone -->
                            <div class="form-group mb-3">
                                <label for="phone" class="font-weight-bold">Téléphone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone', $marchant->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Champ Numéro d'Espace -->
                            <div class="form-group mb-3">
                                <label for="espace_id" class="font-weight-bold">Numéro d'Espace</label>
                                <select name="espace_id" class="form-control @error('espace_id') is-invalid @enderror" id="espace_id">
                                    @forelse($espaces as $espace)
                                        @if ($espace->status == 'Disponible')
                                            <option value="{{ $espace->id }}" {{ old('espace_id', $marchant->espace_id) == $espace->id ? 'selected' : '' }}>
                                                {{ $espace->numero_space }}
                                            </option>
                                        @endif
                                    @empty
                                        <option value="">Aucune espace disponible</option>
                                    @endforelse
                                </select>
                                @error('espace_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="feather icon-save mr-2"></i> Enregistrer
                                </button>
                                <a href="{{ route('marchant.show', $marchant->secteur->id) }}" class="btn btn-secondary btn-lg">
                                    <i class="feather icon-x-circle mr-2"></i> Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
