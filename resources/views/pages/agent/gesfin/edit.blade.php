@extends('layout.layout')

@section('content')
@section('title', 'Gestion Market || Modifier')
<section class="pcoded-main-container">
    <div class="col-xl-12">
        <h2 class="mt-4">Modifier la Dépense</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('finance.update', $finance->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Affichage des erreurs de validation -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="name">Nom de la transaction</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $finance->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description" value="{{ old('description', $finance->description) }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control" id="type">
                            <option value="revenu" {{ old('type', $finance->type) == 'revenu' ? 'selected' : '' }}>Revenu</option>
                            <option value="dépense" {{ old('type', $finance->type) == 'dépense' ? 'selected' : '' }}>Dépense</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Montant</label>
                        <input type="number" name="amount" class="form-control" id="amount" value="{{ old('amount', $finance->amount) }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
