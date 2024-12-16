@extends('layout.layout') 
@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        @section('title', '' .$contrat->numero_contrat )
        <a href="{{ route('contrat.export.pdf', $contrat->id) }}" class="btn btn-danger">Exporter en PDF</a>
        <a href="{{ route('contrat.export.excel', $contrat->id) }}" class="btn btn-success">Exporter en Excel</a>

        <div class="container my-5">
            <h1 class="text-center mb-4">{{ $contrat->contrat_name }}</h1>
            <h2 class="text-center">Conteneur</h2>
            <hr>
            
            <div class="row">
                <div class="col-md-6">
                    <h4>Informations Générales</h4>
                    <ul>
                        <li><strong>Numéro de Contrat :</strong> {{ $contrat->numero_contrat }}</li>
                        <li><strong>Montant :</strong> {{ number_format($contrat->montant, 2, ',', ' ') }} €</li>
                        <li><strong>Date de Début :</strong> {{ $contrat->date_debut }}</li>
                        <li><strong>Date de Fin :</strong> {{ $contrat->date_fin }}</li>
                    </ul>
                </div>
                <div class="col-md-6 text-center">
                    <h4>Scan pour Détails</h4>
                    {{-- Génération du QR Code --}}
                    {!! QrCode::format('svg')->size(150)->generate(route('contrats.details', ['id' => $contrat->id])) !!}

                    <p class="mt-2">Scannez ce code pour voir plus d'informations.</p>
                </div>
            </div>

            <h3 class="mt-4">Objet du Contrat</h3>
            <p>Le présent contrat a pour objet la vente du conteneur ainsi déterminé :</p>
            <ul>
                <li><strong>Localisation du conteneur :</strong> Secteur occupé dans le marché</li>
            </ul>

            <div class="text-end mt-5">
                <p><strong>Fait le :</strong> …………/…………/2024</p>
            </div>

            <h3 class="mt-4">Signatures</h3>
            <div class="row">
                <div class="col-md-4 text-center">
                    <p><strong>Vendeur :</strong> ______________________________</p>
                </div>
                <div class="col-md-4 text-center">
                    <p><strong>Témoin :</strong> ______________________________</p>
                </div>
                <div class="col-md-4 text-center">
                    <p><strong>Acheteur :</strong> ______________________________</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
