@extends('layout.layout')
@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Listes des membres</h2>
                    <a href="{{route('secteur.create')}}"><button class="btn btn-primary">Ajouter un membre</button></a>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOM</th>
                                    <th>Prénom</th>
                                    <th>Status membre</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Membre du bureau</td>
                                    <td>0707102515</td>
                                    <td>
                                        <a href="" class="btn btn-success" title="Modifier"><i class="feather icon-edit" ></i></a>
                                        <a href="" class="btn btn-danger" title="Supprimer"><i class="feather icon-trash-2" ></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>Agent d'encaissement</td>
                                    <td>0181254698</td>
                                    <td>
                                        <a href="" class="btn btn-success" title="Modifier"><i class="feather icon-edit" ></i></a>
                                        <a href="" class="btn btn-danger" title="Supprimer"><i class="feather icon-trash-2" ></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>Agent financier</td>
                                    <td>0151752015</td>
                                    <td>
                                        <a href="" class="btn btn-success" title="Modifier"><i class="feather icon-edit" ></i></a>
                                        <a href="" class="btn btn-danger" title="Supprimer"><i class="feather icon-trash-2" ></i></a>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</section>


@endsection