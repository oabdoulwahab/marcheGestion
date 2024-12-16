<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de Vente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <!-- Titre principal -->
        <h1 class="text-center mb-4">CONTRAT TYPE {{ $contrat->contrat_name }}</h1>
        <h2 class="text-center">Conteneur</h2>
        <hr>

        <!-- Désignation des parties -->
        <h3 class="mt-4">I - DÉSIGNATION DES PARTIES</h3>
        <p class="bg-color-grey">Le présent contrat est conclu entre les soussignés :</p>

        <div class="row">
            <div class="col-md-6">
                <h4>« Le Vendeur »</h4>
                <ul>
                    <li><strong>Nom et prénom du vendeur :</strong> {{ $contrat->vendeur->name }}</li>
                    <li><strong>Objet :</strong> Conteneur</li>
                    <li><strong>Montant :</strong> {{ number_format($contrat->montant, 2, ',', ' ') }} fr CFA</li>
                    <li><strong>Tél :</strong> {{ $contrat->vendeur->phone }}</li>
                    <li><strong>N° du conteneur :</strong> {{ $contrat->numero_contrat }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h4>« L’Acheteur »</h4>
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
            <h4>Scan pour Détails</h4>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const contratId = {{ $contrat->id }}; // Id du contrat, injecté depuis Laravel

            // URL de l'API pour récupérer les données du QR Code
            const apiUrl = `/api/contrat-qrcode/${contratId}`;

            // Effectuer une requête pour récupérer l'URL
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Générer le QR Code avec l'URL reçue
                    const qrcode = new QRCode(document.getElementById("qrcode"), {
                        text: data.url,
                        width: 150,
                        height: 150
                    });
                })
                .catch(error => console.error('Erreur lors de la génération du QR Code:', error));
        });
    </script>