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
   <!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   
    <style>
  
  body {
            background-color: #b5d8b7; /* Light gray background */
            font-family: 'Arial', sans-serif; /* Modern font */
            color: #333; /* Darker text for readability */
        }


.background-cover {
    background-image: url('{{ asset('images/recycleb.png') }}');
    background-size: cover; /* Cover the entire section */
    background-position: center; /* Center the image */
    padding: 50px 0; /* Add padding for vertical space */
    min-height: 100vh; /* Full viewport height */
    display: flex; /* Flexbox for layout */
    align-items: flex-start; /* Align items to the start (top) */
    margin: 0; /* Remove margin */
}
.form-container {
    background: rgba(255, 255, 255, 0.8); /* White background with opacity */
    border-radius: 12px; /* Rounded corners */
    padding: 30px; /* Padding for the form */
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Shadow for the form */
    width: 100%; /* Full width */
    max-width: 400px; /* Max width for the form */
    margin-left: auto; /* Pushes the form to the right */
    margin-right: 50px; /* Adjust margin to the right as needed */
}

.s-content{
    margin-top: 200px;
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
            text-align: center; /* Align left */
            margin-top: 30px;
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
        .btn-primary {
    background-color: #009082; /* Couleur primaire */
    border: none; 
    margin-left: 110px;
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
            background-color: #dc3545; /* Danger color */
        }
        .btn-danger:hover {
            background-color: #c82333; /* Darker shade on hover */
            transform: translateY(-2px); /* Lift effect on hover */
        }

       
    </style>
</head>

<body id="top">

    <!-- Preloader Component -->
    <x-preloader />
   <x-header />
    <!-- Page Wrapper -->
    <div id="page" class="s-pagewrap">
        <!-- Header Component -->
       

        <!-- Section with background image and form -->
        <section id="waste-list" class="s-content container-fluid background-cover">
            <div class="form-container">
            <h4 class="py-3 mb-4">
    <span class="text-muted fw-light">
        <i class="mdi mdi-plus" aria-hidden="true"></i> Ajouter un déchet
    </span>
</h4>
                <form action="{{ route('wastes.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="" disabled selected>Sélectionnez un type</option>
                            <option value="plastique" {{ old('type') == 'plastique' ? 'selected' : '' }}>Plastique</option>
                            <option value="papier" {{ old('type') == 'papier' ? 'selected' : '' }}>Papier</option>
                            <option value="métal" {{ old('type') == 'métal' ? 'selected' : '' }}>Métal</option>
                            <option value="déchets organiques" {{ old('type') == 'déchets organiques' ? 'selected' : '' }}>Déchets Organiques</option>
                            <option value="verre" {{ old('type') == 'verre' ? 'selected' : '' }}>Verre</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Poids (kg)</label>
                        <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" min="0" step="0.01" required>
                        @error('weight')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary ">Ajouter</button>
                    <!-- <button type="button" class="btn btn-danger" onclick="window.location='{{ route('wastes.index') }}'">Annuler</button>
                -->
               
                </form>
            </div>
        </section>

        <!-- Footer Component -->
        <x-footer />
    </div>

     
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    
    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Ajouter Déchet</title>
</head>
<body>
    <h1>Ajouter un Déchet</h1>
    <form id="addWasteForm" action="/votre-endpoint" method="POST">
        <!-- Vos champs de formulaire ici -->
        <input type="text" name="nom" placeholder="Nom du déchet" required>
        <input type="number" name="quantité" placeholder="Quantité" required>
        <button type="submit">Ajouter</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Vérifiez si le message de succès est présent dans les attributs du modèle
            const successMessage = /* Récupérez votre message ici, selon la technologie que vous utilisez */;
            if (successMessage) {
                Swal.fire({
                    title: 'Ajouté!',
                    text: successMessage,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500 // Durée du toast en ms
                });
            }
        });
    </script>
   
</body>
</html>

</body>
</html>
