<div class="modal fade" id="addEspaceModal" tabindex="-1" role="dialog" aria-labelledby="addEspaceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEspaceModalLabel">Ajouter un espace</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('espace.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="numero_espace">Numéro de l'espace</label>
                        <input type="text" name="numero_space" id="numero_espace" class="form-control" placeholder="Ex : E001" required>
                    </div>

                    <div class="form-group">
                        <label for="secteur_id">Secteur associé</label>
                        <select class="form-control" name="secteur_id" id="secteur_id" required>
                            <option value="" disabled selected>Choisissez un secteur</option>
                            @foreach ($secteurs as $secteur)
                                <option value="{{ $secteur->id }}">{{ $secteur->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Le statut sera géré automatiquement, donc pas de champ ici -->

                    <button type="submit" class="btn btn-primary">Ajouter l'espace</button>
                </form>
            </div>
        </div>
    </div>
</div>
