<div class="modal fade" id="addCotisationModal" tabindex="-1" role="dialog" aria-labelledby="addCotisationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCotisationModalLabel">Créer une nouvelle cotisation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <form method="POST" action="{{ route('cotisation.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- Montant total de la cotisation -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Montant total de la
                                            cotisation</label>
                                        <input type="text" class="form-control" id="name"
                                            name="name" placeholder="Entrez le le nom de la cotisation" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="montantTotal" class="form-label">Montant total de la
                                            cotisation</label>
                                        <input type="number" class="form-control" id="montantTotal"
                                            name="montant_total" placeholder="Entrez le montant total" required>
                                    </div>
                                    <!-- Date de début -->
                                    <div class="mb-3">
                                        <label for="dateDebut" class="form-label">Date de début</label>
                                        <input type="date" class="form-control" id="dateDebut" name="date_debut"
                                            required>
                                    </div>

                                    <!-- Date de fin -->
                                    <div class="mb-3">
                                        <label for="dateFin" class="form-label">Date de fin</label>
                                        <input type="date" class="form-control" id="dateFin" required
                                            name="date_fin">
                                    </div>

                                    <!-- Bouton de soumission -->
                                    <button type="submit" class="btn btn-primary">Créer la cotisation</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
