<!-- Fenêtre modale pour ajouter un membre -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Ajouter une Dépense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.finance.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nom de la transaction</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" class="form-control" id="description">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" class="form-control" id="type">
                                            <option value="Achat">Achat</option>
                                            <option value="Vente" selected>Vente</option> <!-- Type par défaut -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Montant</label>
                                        <input type="number" name="amount" class="form-control" id="amount" required>
                                    </div>
                                    <!-- Boutons -->
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Créer la Dépense</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>