@extends('layout.layout')
@section('content')
<section class="pcoded-main-container">
    <div class="col-xl-12">
        <h2 class="mt-4">Modifier la Dépense</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('finance.update', $finance->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nom de la transaction</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $finance->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description" value="{{ $finance->description }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control" id="type">
                            <option value="revenu" {{ $finance->type == 'revenu' ? 'selected' : '' }}>Revenu</option>
                            <option value="dépense" {{ $finance->type == 'dépense' ? 'selected' : '' }}>Dépense</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Montant</label>
                        <input type="number" name="amount" class="form-control" id="amount" value="{{ $finance->amount }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
