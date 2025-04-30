<div class="modal fade" id="addPaiementModal" tabindex="-1" role="dialog" aria-labelledby="addPaiementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaiementModalLabel">Enregistrer un paiement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <!-- Sélection de l'adhérent -->
                                    <div class="mb-3">
                                        <label for="marchant" class="form-label">Sélectionnez l'adhérent</label>
                                        <select class="form-select" id="marchant" required>
                                            <option value="">Choisissez un adhérent</option>
                                            @foreach ($marchands as $marchand)
                                                <option value="{{$marchand->marchant_id}}">{{$marchand->name}} 2</option>
                                            @endforeach
                                            
                                            <!-- Ajoutez d'autres adhérents dynamiquement -->
                                        </select>
                                    </div>

                                    <!-- Sélection de la cotisation -->
                                    <div class="mb-3">
                                        <label for="cotisation" class="form-label">Sélectionnez la cotisation</label>
                                        <select class="form-select" id="cotisation" required>
                                            <option value="">Choisissez une cotisation</option>
                                            @foreach ($cotisations as $cotisation)
                                                <option value="{{$cotisation->cotisation_id}}">Cotisation du {{$cotisation->date_debut}} au {{$cotisation->date_fin}}</option>
                                            @endforeach
                                            
                                            <!-- Ajoutez d'autres cotisations dynamiquement -->
                                        </select>
                                    </div>

                                    <!-- Montant du paiement -->
                                    <div class="mb-3">
                                        <label for="montantPaiement" class="form-label">Montant du paiement</label>
                                        <input type="number" class="form-control" id="montantPaiement"
                                            placeholder="Entrez le montant payé" required>
                                    </div>

                                    <!-- Date du paiement -->
                                    <div class="mb-3">
                                        <label for="datePaiement" class="form-label">Date du paiement</label>
                                        <input type="date" class="form-control" id="datePaiement" required>
                                    </div>

                                    <!-- Bouton de soumission -->
                                    <button type="submit" class="btn btn-primary">Enregistrer le paiement</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
