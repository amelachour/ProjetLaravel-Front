

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecycleMe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">


    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

    
    <style>
       
        body {
            background-color: #b5d8b7; /* Light gray background */
            font-family: 'Arial', sans-serif; /* Modern font */
            color: #333; /* Darker text for readability */
        }
        .s-content{
    margin-top: 130px;
}
.header {
            background-color: #729a75; /* Main header color */
            padding: 15px 0; /* Padding for header */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
            height: 110px; /* Fixed height */
        }
        .s-header__logo img {
            width: 150px; /* Logo size */
        }
        .s-header__nav ul {
            padding-left: 0;
            list-style: none; /* Remove bullets */
            display: flex; /* Use flexbox for horizontal layout */
            align-items: center; /* Center items vertically */
        }
        .s-header__nav ul li {
            margin: 0 15px; /* Space between items */
        }
        .s-header__nav a {
            text-decoration: none; /* Remove underline */
            color: white; /* Link color */
            font-weight: 600; /* Bold links */
            transition: color 0.3s;
        }
        .s-header__nav a:hover {
            color: #ffcc00; /* Gold color on hover */
        }

        h4 {
            text-align: center;
            margin-top: 80px;
            margin-bottom: 1rem;
            color: #333;
            font-weight: bold;
            font-size: 32px; /* Larger title font */
        }
        .card {
            border: none; /* Remove border */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); /* Stronger shadow */
        }
        .card-header {
            background-color: #6c757d; /* Darker card header */
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 12px 12px 0 0; /* Rounded top corners */
            padding: 15px; /* Padding for header */
        }
        .table th, .table td {
            vertical-align: middle; /* Center align content */
            font-size: 16px; /* Increase font size */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #e9ecef; /* Alternate row colors */
        }
        .btn {
            border-radius: 25px; /* More rounded corners */
            padding: 10px 20px; /* More padding for buttons */
            font-weight: bold; /* Bold button text */
            transition: background-color 0.3s, transform 0.3s; /* Smooth transition */
        }
        .bet{
            margin-left: 65px;
        }
        .btn-primary {
    background-color: #009082; /* Couleur primaire */
    border: none; 
    height: 40px; /* Hauteur du bouton */
    color: white; /* Couleur du texte */
    padding: 0 20px; /* Ajustez le padding gauche et droit */
    font-size: 16px; /* Taille de la police (ajustez si nécessaire) */
    display: flex; /* Utiliser flexbox pour centrer le texte */
    align-items: center; /* Centrer le texte verticalement */
    justify-content: center; /* Centrer le texte horizontalement */
}


        .btn-primary:hover {
            background-color: #00705d; /* Darker shade on hover */
            transform: translateY(-2px); /* Lift effect on hover */
        }
        .btn-danger {
            background-color: #dc3545; 
          
    height: 44px; 
    color: white; 
    padding: 0 20px; 
    font-size: 16px; 
    display: flex; 
    align-items: center; 
    justify-content: center;
            
           
        }
        .btn-danger:hover {
            background-color: #c82333; /* Darker shade on hover */
            transform: translateY(-2px); /* Lift effect on hover */
        }
        .form-control {
    height: 50px; /* Augmentez la hauteur des champs */
    padding: 10px; /* Ajustez le padding pour plus de confort */
    font-size: 16px; /* Augmentez la taille de la police si nécessaire */
}

.form-select {
    height: 50px; /* Assurez-vous que la liste déroulante a également une hauteur adéquate */
    padding: 10px; /* Ajustez le padding pour la liste déroulante */
    font-size: 16px; /* Augmentez la taille de la police si nécessaire */
}

    </style>
</head>

<body id="top">

    <!-- Preloader Component -->
    <x-preloader />
 <x-header />
    <!-- Page Wrapper -->
    <div id="page" class="s-pagewrap">
   

    <section id="waste-list" class="s-content container">
    <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">
        <i class="mdi mdi-recycle" aria-hidden="true"></i> Gestion des déchets
    </span>
</h4>


    <div class="row py-3 mt-5"> 
        <!-- Left Column (Form) -->
        <div class="col-md-6 mt-5">
            <form action="{{ route('wastes.update', $waste->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type" style="width: 100%;"> <!-- Changed width to 100% -->
                        <option value="" disabled>Sélectionnez un type</option>
                        <option value="plastique" {{ old('type', $waste->type) == 'plastique' ? 'selected' : '' }}>Plastique</option>
                        <option value="papier" {{ old('type', $waste->type) == 'papier' ? 'selected' : '' }}>Papier</option>
                        <option value="métal" {{ old('type', $waste->type) == 'métal' ? 'selected' : '' }}>Métal</option>
                        <option value="déchets organiques" {{ old('type', $waste->type) == 'déchets organiques' ? 'selected' : '' }}>Déchets Organiques</option>
                        <option value="verre" {{ old('type', $waste->type) == 'verre' ? 'selected' : '' }}>Verre</option>
                    </select>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Poids (kg)</label>
                    <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight', $waste->weight) }}" required min="0" step="0.01" style="width: 100%;"> <!-- Adjusted width -->
                    @error('weight')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex mt-3 justify-content-center"> 
                    <button type="submit" class="btn btn-primary mr-3">Modifier</button>
                    <button type="button" class="btn btn-danger" onclick="window.location='{{ route('wastes.index') }}'">Annuler</button>
                </div>
            </form>
        </div>

        <!-- Right Column (Image and Text) -->
        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
        <img src="{{ asset('images/recycling-info.png') }}" alt="Recycling Info" class="img-fluid mb-4 " style="max-width: 80%; margin-left:140px;">

            <div class="text-center">
               
            </div>
        </div>
    </div>
</section>




<x-footer />
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
</body>
</html>