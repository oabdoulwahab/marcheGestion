@extends('layout.layout')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Listes des membres</h2>
                        <!-- Bouton pour ouvrir la fenêtre modale -->
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">Ajouter un
                            membre</button>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOM et Prénom</th>
                                        <th>Rôle membre</th>
                                        <th>Numéro de téléphone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemple de contenu statique pour la table -->
                                    @forelse ($personnels as $personnel)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $personnel->name }}</td>
                                            <td>{{ $personnel->role }}</td>
                                            <td>{{ $personnel->contact }}</td>
                                            <td>
                                                <a href="{{ route('personnel.edit', $personnel->id) }}" class="btn btn-success" title="Modifier"><i
                                                        class="feather icon-edit"></i></a>
                                                <form action="{{ route('personnel.destroy', $personnel->id) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce personnel?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                {{-- <a href="#" class="btn btn-danger" title="Supprimer"><i class="feather icon-trash-2"></i></a> --}}
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    <!-- Autres lignes -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fenêtre modale pour ajouter un membre -->
        <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMemberModalLabel">Ajouter un membre</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('personnel.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="lastName">Nom</label>
                                <input type="text" class="form-control" name="name" id="lastName"
                                    placeholder="Entrez le nom complet">
                            </div>
                            <div class="form-group">
                                <label for="status">Rôle</label>
                                    <select class="form-control" name="role" id="status">
                                @foreach ($roles as $role)
                                <option value="{{$role->role}}">{{$role->role}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Numéro de téléphone</label>
                                <input type="text" class="form-control" name="contact" id="phone"
                                    placeholder="Entrez le numéro de téléphone">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __(' Addresse E-mail') }}</label>
                               
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="Entrez l'addresse E-mail"  required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>

                            {{-- <div class="form-group">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div> --}}


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
