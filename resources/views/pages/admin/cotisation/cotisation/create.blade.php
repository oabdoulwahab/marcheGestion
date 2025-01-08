<!-- Modal pour ajouter des adhérents -->
<div class="modal fade" id="addAdherentModal" tabindex="-1" role="dialog" aria-labelledby="addAdherentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAdherentModalLabel">Ajouter des adhérents à la cotisation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cotisation.addAdherents', $cotisation->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="adherents">Sélectionnez un adhérent</label>
                        <select name="adherents" id="adherents" class="form-control">
                            <option value="" disabled selected>Sélectionnez un adhérent</option>
                            @forelse($marchands as $marchand)
                                <option value="{{ $marchand->id }}">{{ $marchand->name }}</option>
                            @empty
                                <option value="" disabled selected>Aucun adhérent disponible</option>
                            @endforelse
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
