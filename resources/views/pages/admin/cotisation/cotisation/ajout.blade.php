<!-- Modal pour ajouter un paiement -->
<div class="modal fade" id="addPaiementModal{{ $marchant->id }}" tabindex="-1" role="dialog" aria-labelledby="addPaiementModalLabel{{ $marchant->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaiementModalLabel{{ $marchant->id }}">Ajouter un paiement pour {{ $marchant->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('paiement.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="marchant_id" value="{{ $marchant->id }}">
                    <input type="hidden" name="cotisation_id" value="{{ $cotisation->id }}">
                    <input type="hidden" name="date_paiement" value="{{ now()->toDateString() }}">

                    <div class="form-group">
                        <label for="montant">Montant du paiement</label>
                        <input type="number" step="0.01" class="form-control" id="montant" name="montant" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>