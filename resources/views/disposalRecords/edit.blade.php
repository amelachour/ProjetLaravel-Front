<!DOCTYPE html>
<html lang="fr" class="no-js">
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
        .s-content {
            margin-top: 270px;
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
       
        .card {
            border: none; /* Remove border */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); /* Stronger shadow */
            margin-right: 20px; /* Space between card and image */
            margin-bottom: 30px;
        }
        .card-header {
            background-color: #6c757d; /* Darker card header */
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 12px 12px 0 0; /* Rounded top corners */
            padding: 15px; /* Padding for header */
        }
        h4 {
            text-align: center;
            margin-top: 20px;
            color: #333;
            font-weight: bold;
            font-size: 24px; /* Larger title font */
        }
        .image-container {
            text-align: center; 
           
        }
        .image-container img {
            max-width: 100%; 
            height: auto; /* Maintain aspect ratio */
            border-radius: 12px; /* Rounded corners for the image */
            margin-left: 120px;
        }
        .btn {
    background-color: #009082; /* Couleur primaire */
    border: none; 
   
    height: 40px; 
    color: white; /* Couleur du texte */
    padding: 0 20px; /* Ajustez le padding gauche et droit */
    font-size: 16px; /* Taille de la police (ajustez si nécessaire) */
    display: flex; /* Utiliser flexbox pour centrer le texte */
    align-items: center; /* Centrer le texte verticalement */
    justify-content: center; /* Centrer le texte horizontalement */
}

.btn-danger {
    background-color: grey;
}
       
     
    </style>
</head>

<body id="top">

    <!-- Preloader Component -->
    <x-preloader />
    <x-header />
    <!-- Page Wrapper -->
    <div id="page" class="s-pagewrap">
       
        <section id="waste-list" class="s-content container d-flex justify-content-center align-items-start">

            <div class="card p-4" style="width: 40%;">
                <h4 class="mb-4"><span class="text-muted fw-light"> Demande d’élimination</span></h4>
                <form action="{{ route('disposalRecords.update', $disposalRecord->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
    <label for="waste_id" class="form-label">Déchet</label>
    <select class="form-select" id="waste_id" name="waste_id" required>
        @foreach($wastes as $waste)
            <option value="{{ $waste->id }}" {{ $waste->id == $disposalRecord->waste_id ? 'selected' : '' }}>
                {{ $waste->type }}
            </option>
        @endforeach
    </select>
    @error('waste_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


                    <div class="mb-3">
                        <label for="method" class="form-label">Méthode d’Élimination</label>
                        <input type="text" class="form-control" id="method" name="method" value="{{ old('method', $disposalRecord->method) }}" required>
                        @error('method')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="disposal_date" class="form-label">Date d’Élimination</label>
                        <input type="date" class="form-control" id="disposal_date" name="disposal_date" value="{{ old('disposal_date', $disposalRecord->disposal_date) }}" required>
                        @error('disposal_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $disposalRecord->location) }}" required>
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex mt-3 justify-content-center"> 
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <button type="button" class="btn btn-danger" onclick="window.location='{{ route('disposalRecords.index') }}'">Annuler</button>
                    </div>         
                </form>
            </div>

            <div class="image-container">
                <img src="{{ asset('images/eliminatee.png') }}" alt="Elimination Image">
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
