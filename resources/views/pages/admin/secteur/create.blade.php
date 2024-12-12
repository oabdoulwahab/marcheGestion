@extends('layout.layout')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
                        <hr>
                        <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control" id="nom" placeholder="Ex: Konan">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" class="form-control" id="prenom" placeholder="Ex: Albert">
                                    </div>
                                
                                <div class="form-group col-md-6 ">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" placeholder="Ex: agent">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Numéro de téléphone</label>
                                    <input type="phone" class="form-control" id="phone" placeholder="0748xxxxxxx">
                                </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn  btn-primary btn-lg">Enregistrer</button>
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn  btn-primary btn-lg">Annuler</button>
                            </div>
                        </form>
                    </div>
               
        </div>
    </section>

    <div class="container">
        <h1>Créer un secteur</h1>
    
        <form action="{{ route('secteur.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom du secteur</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
    
            <div class="mb-3">
                <label for="fee" class="form-label">Frais</label>
                <input type="number" step="0.01" name="fee" id="fee" class="form-control" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection