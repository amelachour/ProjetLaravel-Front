<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecycleMe - Liste des Équipements</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    body {
        background-color: #b5d8b7; /* Light background */
        font-family: 'Arial', sans-serif; /* Modern font */
        color: #333; /* Darker text for readability */
    }

    .s-content {
        margin-top: 100px;
    }

    .header {
        background-color: #729a75; /* Header color */
        padding: 15px 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
        height: 110px;
    }

    h4 {
        text-align: center;
        margin-top: 120px;
        margin-bottom: 1rem;
        color: #333;
        font-weight: bold;
        font-size: 32px;
    }

    .card {
    margin-bottom: 60px; /* Espacement entre les cartes */
    height: 600px; /* Nouvelle hauteur des cartes */
    display: flex; /* Utilisation de flex pour une meilleure disposition */
    flex-direction: column; /* Disposition en colonne */
    justify-content: space-between; /* Espacement uniforme */
    text-align: center; /* Centrer le texte */
}

.card-img-top {
    width: 100%; /* Image prenant toute la largeur */
    height: 400px; /* Nouvelle hauteur de l'image */
    object-fit: cover; /* Couvrir le conteneur sans déformer l'image */
}

.card-header {
    font-size: 28px; /* Taille de la police pour le nom de l'équipement */
}

.card-body p {
    font-size: 20px; /* Taille de la police pour les détails */
}


    .card-header {
        background-color: #729a75; /* Couleur de fond de l'en-tête de la carte */
        color: white; /* Couleur du texte de l'en-tête */
        font-weight: bold; /* Texte en gras */
        font-size: 24px; /* Augmenter la taille de la police */
    }

    .card-body {
        background-color: white; /* Couleur de fond du corps de la carte */
        display: flex; /* Utilisation de flex pour un meilleur alignement */
        flex-direction: column; /* Colonne pour empiler les éléments */
        justify-content: space-between; /* Espacement uniforme entre les éléments */
        flex-grow: 1; /* Permet au corps de la carte d'occuper tout l'espace disponible */
    }

    .card-body p {
        margin-bottom: 10px; /* Espacement en bas des paragraphes */
        font-size: 18px; /* Augmenter la taille de la police */
    }

    .card-img-top {
        width: 100%; /* Image prenant toute la largeur */
        height: 300px; /* Augmenter la hauteur de l'image à 300px */
        object-fit: cover; /* Couvrir le conteneur sans déformer l'image */
    }

    .btn {
        width: 100%; /* Bouton prenant toute la largeur de la carte */
    }
    </style>
</head>

<body id="top">

    <!-- Preloader Component -->
    <x-preloader />
    <x-header />

    <div id="page" class="s-pagewrap">
        <section id="equipment-list" class="s-content container">
            <h4 class="py-3 mb-4">Liste des Équipements</h4>

            <div class="row">
                @foreach($equipments as $equipment)
                <div class="col-md-4"> <!-- Utilise des colonnes Bootstrap pour les cartes -->
    <div class="card mb-4"> <!-- Ajoute la classe mb-4 pour l'espacement -->
        <img src="{{ env('BACKEND_URL') }}/storage/{{ $equipment->image_path }}" alt="{{ $equipment->name }}" class="card-img-top">
        <div class="card-header">
            {{ $equipment->name }} <!-- Nom de l'équipement -->
        </div>
        <div class="card-body">
            <p><strong>Type:</strong> {{ $equipment->type }}</p>
            <p><strong>Date d'Achat:</strong> {{ \Carbon\Carbon::parse($equipment->purchase_date)->format('d-m-Y') }}</p>
            <a href="{{ route('equipment.show', $equipment->id) }}" class="btn btn-primary" title="Voir Détails">
                Détails
            </a>
        </div>
    </div>
</div>

                @endforeach
            </div>
        </section>

        <!-- Footer Component -->
        <x-footer />
    </div>

    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
