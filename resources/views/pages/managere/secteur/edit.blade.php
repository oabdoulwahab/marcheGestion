@extends('layout.layout')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <h5 class="mt-5">Form Grid</h5>
                        <hr>
                        <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nom">Nom</label>
                                        <input type="text" value="" class="form-control" id="nom" placeholder="Ex: Konan">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" value="" class="form-control" id="prenom" placeholder="Ex: Albert">
                                    </div>
                                
                                <div class="form-group col-md-6 ">
                                    <label for="status">Status</label>
                                    <input type="text" value="" class="form-control" id="status" placeholder="Ex: agent">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Numéro de téléphone</label>
                                    <input type="phone" value=""  class="form-control" id="phone" placeholder="0748xxxxxxx">
                                </div>

                                {{-- <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">City</label>
                                        <input type="text" class="form-control" id="inputCity">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">State</label>
                                        <select id="inputState" class="form-control">
                                            <option selected>select</option>
                                            <option>Large select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">Zip</label>
                                        <input type="text" class="form-control" id="inputZip">
                                    </div>
                                </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">Check me out</label>
                                </div>
                            </div> --}}
                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="submit" class="btn btn-primary btn-lg active" data-mdb-ripple-init role="button" aria-pressed="true">Mettre à jour</button>
                            
                                <button type="submit" class="btn btn-danger btn-lg active" data-mdb-ripple-init role="button" aria-pressed="false">Annuler</button>
                           
                           
                            </div>
                        </form>
                    </div>
               
        </div>
    </section>


@endsection