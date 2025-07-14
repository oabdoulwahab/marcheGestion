@extends('layout.layout') 
@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        @section('title', '' .$contrat->numero_contrat )
        <a href="{{ route('contrat.export.pdf', $contrat->id) }}" class="btn btn-danger">Exporter en PDF</a>
        <a href="{{ route('contrat.export.excel', $contrat->id) }}" class="btn btn-success">Exporter en Excel</a>

        <div class="container my-5">
            <!-- Titre principal -->
            <h1 class="text-center mb-4">CONTRAT DE {{ $contrat->contrat_name }}</h1>
            <h2 class="text-center">Conteneur</h2>
            <hr>
    
            <!-- Désignation des parties -->
            <h3 class="mt-4">I - DÉSIGNATION DES PARTIES</h3>
            <p class="bg-color-grey">Le présent contrat est conclu entre les soussignés :</p>
    
            <div class="row">
                <div class="col-md-6">
                    <h2 class=" text-xl">Le Vendeur </h2>
                    <ul>
                        <li><strong>Nom et prénom du vendeur :</strong> {{ $contrat->vendeur->name }}</li>
                        <li><strong>Objet :</strong> Conteneur</li>
                        <li><strong>Montant :</strong> {{ number_format($contrat->montant, 2, ',', ' ') }} fr CFA</li>
                        <li><strong>Tél :</strong> {{ $contrat->vendeur->phone }}</li>
                        <li><strong>N° du conteneur :</strong> {{ $contrat->numero_contrat }}</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>« L’Acheteur »</h2>
                    <ul>
                        <li><strong>Nom et prénom de l’acheteur :</strong> {{ $contrat->acheteur->name }}</li>
                        <li><strong>Tél :</strong> {{ $contrat->acheteur->phone }}</li>
                        <li><strong>Activité exercée :</strong> {{ $contrat->acheteur->Activite }}</li>
                    </ul>
                </div>
            </div>
    
            <!-- Objet du contrat -->
            <h3 class="mt-4">Objet du Contrat</h3>
            <p>Le présent contrat a pour objet la vente du conteneur ainsi déterminé :</p>
            <ul>
                <li><strong>Localisation du conteneur :</strong> Secteur occupé dans le marché</li>
            </ul>
    
            <!-- Date -->
            <div class="text-end mt-5">
                
                <p><strong>Fait le :</strong> …………/…………/2024</p>
            </div>
    
            {{-- <!-- QR Code -->
            <div class="text-center">
                <h2>Scan pour Détails</h2>
                <div id="qrcode"></div>
                <p class="mt-2">Scannez ce code pour voir plus d'informations.</p>
            </div> --}}
    
            <!-- Signatures -->
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
