  <!-- Modal de création de contrat -->
  <div class="modal fade" id="addMarchantModal" tabindex="-1" role="dialog" aria-labelledby="addMarchantModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="addMarchantModalLabel">Ajouter un commerçant</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('marchant.store') }}" method="POST">
                      @csrf

                      <div class="form-group">
                          <label for="name">Nom du commerçant</label>
                          <input type="text" name="name" id="name" class="form-control"
                              placeholder="Nom complet" required>
                      </div>

                      <div class="form-group">
                          <label for="address">Adresse du commerçant</label>
                          <input type="text" name="address" id="address" class="form-control"
                              placeholder="Adresse complète">
                          <small class="text-muted">Optionnel</small>
                      </div>

                      <div class="form-group">
                          <label for="phone">Numéro de téléphone</label>
                          <input type="text" name="phone" id="phone" class="form-control"
                              placeholder="Ex : +237 6XX XXX XXX">
                          <small class="text-muted">Optionnel</small>
                      </div>

                      <div class="form-group">
                          <label for="secteur_id">Secteur d'activité</label>
                          <select class="form-control" name="secteur_id" id="secteur_id" required>
                              <option value="" disabled selected>Choisissez un secteur</option>
                              @foreach ($secteurs as $secteur)
                                  <option value="{{ $secteur->id }}">{{ $secteur->name }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="form-group">
                          <label for="espace_id">Espace attribué</label>
                          <select class="form-control" name="espace_id" id="espace_id">
                              <option value="" disabled selected>Choisissez un espace</option>
                              @forelse($espaces as $espace)
                                  @if ($espace->status == 'Disponible')
                                      <option value="{{ $espace->id }}">{{ $espace->numero_space }}</option>
                                  @endif

                              @empty
                                  <option value="" disabled selected>Aucune espace disponible</option>
                              @endforelse

                          </select>
                          <small class="text-muted">Optionnel</small>
                      </div>

                      <button type="submit" class="btn btn-primary">Ajouter le commerçant</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
