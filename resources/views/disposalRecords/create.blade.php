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
        .s-content {
            margin-top: 100px;
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
            margin-top: 120px;
            margin-bottom: 1rem;
            color: #333;
            font-weight: bold;
            font-size: 32px; /* Larger title font */
        }
        .form-container {
            background-color: #ffffff; /* White background for the form */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2); /* Stronger shadow */
            padding: 30px; /* Padding for the form */
            transition: transform 0.3s ease; /* Animation on hover */
          
        }
        .form-container:hover {
            transform: translateY(-5px); /* Lift effect on hover */
        }
        .form-control {
            transition: border-color 0.3s, box-shadow 0.3s; /* Smooth transition */
        }
        .form-control:focus {
            border-color: #009082; /* Primary color */
            box-shadow: 0 0 5px rgba(0, 144, 130, 0.5); /* Focus effect */
        }
        .btn {
            border-radius: 25px; /* More rounded corners */
            padding: 0px 20px; /* More padding for buttons */
            font-weight: bold; /* Bold button text */
            transition: background-color 0.3s, transform 0.3s; /* Smooth transition */
            color:white;
            height:60px;
          margin-left: 450px;
        }
        .btn-primary {
            background-color: #009082; /* Primary color */
            border: none; 
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

    <x-preloader />
    <x-header />
    
    <div id="page" class="s-pagewrap">
        <section id="content" class="s-content container">

        <h4 class="py-3 mb-5">
    <i class="mdi mdi-folder" style="margin-right: 8px; "></i>
    <span class="text-muted fw-light">Demande d’Élimination</span>
</h4>


            <div class="form-container mt-5">
                <form action="{{ route('disposalRecords.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="waste_id" class="form-label">Déchet</label>
                        <select class="form-select" id="waste_id" name="waste_id" required>
                            <option value="" disabled selected>Sélectionnez un déchet</option>
                            @foreach($wastes as $waste)
                                <option value="{{ $waste->id }}" {{ old('waste_id') == $waste->id ? 'selected' : '' }}>
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
                        <input type="text" class="form-control" id="method" name="method" value="{{ old('method') }}" required>
                        @error('method')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="disposal_date" class="form-label">Date d’Élimination</label>
                        <input type="date" class="form-control" id="disposal_date" name="disposal_date" value="{{ old('disposal_date') }}" required>
                        @error('disposal_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                        @error('location')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary ">Ajouter</button>
                </form>
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
