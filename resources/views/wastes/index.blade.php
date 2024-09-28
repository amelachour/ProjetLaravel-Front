
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
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
        .card-title{
            margin-top: -15px;
            text-align:center;
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
    height: 40px; /* Hauteur du bouton */
    width: 25%;
   margin-left: 850px;
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
  



<style>
    /* Navbar styling */
    .navbar-nav .nav-link {
        font-size: 18px;
        color: white;
        margin-right: 25px;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #ffcc00; /* Gold hover effect */
    }

    .navbar-toggler {
        border-color: transparent;
    }

    .navbar-toggler:hover {
        background-color: #009082;
    }

    .navbar-light .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.9)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    .btn-outline-light {
        color: white;
        border: 2px solid white;
        font-size: 16px;
    }

    .btn-outline-light:hover {
        color: #009082;
        background-color: white;
        border-color: white;
    }
</style>



      
        <section id="waste-list" class="s-content container ">
    <h4 class="py-3 mb-4">Liste des Déchets</h4>
    <div class="text-right mb-3">
        <a href="{{ route('wastes.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus me-1"></i> Enregistrer un Déchet
        </a>
    </div>
    
    <div class="row">
        @foreach($wastes as $waste)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 hover-card">
                    <img src="{{ asset('images/waste_types/' . strtolower($waste->type) . '.png') }}" class="card-img-top" alt="{{ $waste->type }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ ucfirst($waste->type) }}</h5>
                        <p><strong>Poids:</strong> {{ $waste->weight }} kg</p>
                        <p><strong>Date de création:</strong> {{ $waste->created_at->format('d-m-Y') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge {{ $waste->status == 'éliminé' ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($waste->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="card-footer text-right">
    <a href="{{ route('wastes.edit', $waste->id) }}" title="Modifier" style="color: #009082;">
        <i class="mdi mdi-pencil" style="font-size: 28px;"></i>
    </a>
    <form action="{{ route('wastes.destroy', $waste->id) }}" method="POST" class="delete-form" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="delete-btn" title="Supprimer" style="border: none; background: none; padding: 0; cursor: pointer;">
            <i class="mdi mdi-trash-can" style="font-size: 28px; color: #dc3545;"></i>
        </button>
    </form>
</div>

                </div>
            </div>
        @endforeach
    </div>
</section>

<style>
    .hover-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }
    .card img {
        height: 200px; /* Ajustez la hauteur de l'image */
        object-fit: cover; /* Gardez le ratio d'aspect */
    }
</style>
             <!-- Footer Component -->
             <x-footer />
    </div>

    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); 

            Swal.fire({
                title: 'Voulez-vous vraiment supprimer?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non',
                customClass: {
                    confirmButton: 'btn-confirm',
                    cancelButton: 'btn-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
<style>
   
    .swal2-styled.swal2-confirm.btn-confirm {
        background-color: #d33 !important; 
        border-radius: 20px; 
        font-size: 14px; 
        padding: 5px 15px; 
    }

    
    .swal2-styled.swal2-cancel.btn-cancel {
        background-color: #3085d6 !important; 
        border-radius: 20px; 
        font-size: 14px; 
        padding: 5px 15px; 
    }

   
    .swal2-styled:focus {
        box-shadow: none !important; 
    }
</style>

</body>
</html>
