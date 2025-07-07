@extends('layout.layout')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="container">
                <h1>Modifier l'utilisateur</h1>

                <form action="{{ route('admin.personnel.update', $personnel->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $personnel->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse E-mail</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $personnel->email) }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact">Numéro de téléphone</label>
                        <input type="text" name="contact" id="contact" class="form-control"
                            value="{{ old('contact', $personnel->phone) }}">
                        @error('contact')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Rôle</label>
                        <select name="role" id="role" class="form-control" required>
                             @foreach ($personnels as $personnel) 
                                <option value="{{ $personnel->role }}" {{ $personnel->role == $personnel->role ? 'selected' : '' }}>
                                    {{ $personnel->role }}
                                </option>
                             @endforeach 
                        </select>
                        @error('role_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe (laisser vide pour ne pas changer)</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('admin.personnel.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </section>
@endsection
