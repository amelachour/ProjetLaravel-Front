<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecycLab - Détails de l'Équipement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/vendor.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
    background-color: #b5d8b7; /* Couleur de fond verte */
    font-family: 'Arial', sans-serif; /* Police moderne */
    color: #333; /* Texte plus sombre pour la lisibilité */
}

.container {
    margin-top: 200px; /* Pour correspondre à l'espacement du second code */
}

#about {
    background-color:#b5d8b7; /* Fond vert pour la section */
    padding: 20px; /* Ajoute du rembourrage pour un espacement intérieur */
    border-radius: 8px; /* Coins arrondis */
}

h2.title-center {
    text-align: center;
    color: #fff; /* Couleur du texte en blanc pour un meilleur contraste */
    font-size: 32px; /* Taille du texte */
    font-weight: bold;
    margin-top: 20px; /* Ajustement de la marge */
    margin-bottom: 20px; /* Ajustement de la marge */
}

h3 {
    text-align: center;
    color: #fff; /* Couleur du texte en blanc pour un meilleur contraste */
    font-size: 24px; /* Taille du texte */
    margin-bottom: 30px; /* Espace en bas */
}

.category-cards-containerr {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.category-card {
    background-color: #729a75; /* Couleur de fond verte pour la carte */
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 350px;
    margin-bottom: 20px;
    padding: 15px;
    transition: transform 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
}

.category-card-header h4 {
    font-size: 18px;
    color: #fff; /* Couleur du texte en blanc pour un meilleur contraste */
    margin-bottom: 10px;
}

.category-card-body p {
    font-size: 16px;
    color: #fff; /* Couleur du texte en blanc pour un meilleur contraste */
    margin-bottom: 10px;
}

.text-center {
    text-align: center;
    font-size: 18px;
    color: #fff; /* Couleur du texte en blanc pour un meilleur contraste */
}

    </style>
</head>

<body id="top">
    <!-- Preloader Component -->
    <x-preloader />

    <!-- Page Content -->
    <div id="page" class="s-pagewrap">
        <!-- Header Component -->
        <x-header />

        <!-- Equipment Details Section -->
        <section id="about" class="s-about target-section container">
            <h2 class="title-center">Détails de l'Équipement: {{ $equipment->name }}</h2>

            <h3>Historique des Maintenances</h3>

            <div class="category-cards-containerr">
                @if($maintenances->isNotEmpty())
                    @foreach($maintenances as $maintenance)
                        <div class="category-card">
                            <div class="category-card-header">
                                <h4>
                                    <strong>Date de Maintenance: {{ \Carbon\Carbon::parse($maintenance->maintenance_date)->format('d-m-Y') }}</strong>
                                </h4>
                            </div>
                            <div class="category-card-body">
                                <p>Détails: {{ $maintenance->details }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">Aucune maintenance trouvée pour cet équipement.</p>
                @endif
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
