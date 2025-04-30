
    <div class="container mt-5">
        <h2>Enregistrer un paiement</h2>
        <form>
            <!-- Sélection de l'adhérent -->
            <div class="mb-3">
                <label for="marchant" class="form-label">Sélectionnez l'adhérent</label>
                <select class="form-select" id="marchant" required>
                    <option value="">Choisissez un adhérent</option>
                    <option value="2">Adhérent 2</option>
                    <!-- Ajoutez d'autres adhérents dynamiquement -->
                </select>
            </div>

            <!-- Sélection de la cotisation -->
            <div class="mb-3">
                <label for="cotisation" class="form-label">Sélectionnez la cotisation</label>
                <select class="form-select" id="cotisation" required>
                    <option value="">Choisissez une cotisation</option>
                    <option value="2">Cotisation Mensuelle Janvier 2023</option>
                    <!-- Ajoutez d'autres cotisations dynamiquement -->
                </select>
            </div>

            <!-- Montant du paiement -->
            <div class="mb-3">
                <label for="montantPaiement" class="form-label">Montant du paiement</label>
                <input type="number" class="form-control" id="montantPaiement" placeholder="Entrez le montant payé"
                    required>
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

