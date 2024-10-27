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

    <style>
        body {
            background-color: #b5d8b7; /* Light gray background */
            font-family: 'Arial', sans-serif; /* Modern font */
            color: #333; /* Darker text for readability */
        }
        .header {
            background-color: #729a75; /* Main header color */
            padding: 15px 0; /* Padding for header */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
            height: 110px; /* Fixed height */
        }
        .s-content {
            margin-top: 100px;
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
            background-color: #009082;
            height: 60px;
            font-weight: bold;
            text-align: center !important;
        }
        .table th, .table td {
            vertical-align: middle; /* Center align content */
            font-size: 16px; /* Increase font size */
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
        }
        .alert-container {
            position: relative; /* Position relative pour le conteneur */
            display: flex; /* Utilisation de flexbox pour l'alignement */
            justify-content: flex-end; /* Aligne le contenu à droite */
            margin-top: 120px;
            margin-bottom: 20px; /* Espace en bas du conteneur */
        }
        .custom-alert {
            font-size: 1.25rem; /* Taille de la police plus grande */
            border-radius: 10px; /* Coins arrondis */
            margin-left: 10px; /* Espace entre les alertes si plusieurs sont affichées */
            max-width: 500px; /* Largeur maximale pour les alertes */
        }
        .alert-success {
            background-color: #ffcc00; /* Couleur de fond pour le succès */
            color: #155724; /* Couleur du texte pour le succès */
        }
        .alert-danger {
            background-color: #f8d7da; /* Couleur de fond pour l'erreur */
            color: #721c24; /* Couleur du texte pour l'erreur */
        }
        .card-title{
            margin-top:-5px;
        }
    </style>
</head>

<body id="top">

    <!-- Preloader Component -->
    <x-preloader />
    <x-header />

    <!-- Page Wrapper -->
    <div id="page" class="s-pagewrap">
        <section id="content" class="s-content container">
            <div class="container">
                <div class="alert-container"> <!-- Conteneur pour l'alignement -->
                    @if(session('success'))
                        <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <h4 class="py-3 mb-4">Liste des Enregistrements d’Élimination</h4>

            <!-- Add Button -->
            <div class="text-right mb-3">
                <a href="{{ route('disposalRecords.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus me-1"></i> Demande d'élimination
                </a>
            </div>

            <!-- Card Container -->
            <div class="row mt-5">
                @foreach($disposalRecords as $record)
                    <div class="col-md-4 mb-4"> <!-- 3 cards per row -->
                        <div class="card shadow-sm border-0 hover-card {{ $record->status == 'traitée' ? 'blurred' : '' }}">
                            <div class="card-header text-white" style="{{ $record->status == 'traitée' ? 'opacity: 0.5;' : '' }}">
                                <h5 class="card-title">{{ $record->waste->type }}</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Méthode:</strong> {{ $record->method }}</p>
                                <p><strong>Lieu:</strong> {{ $record->location }}</p>
                                <p><strong>Status:</strong> <span class="badge badge-{{ $record->status == 'Completed' ? 'success' : 'warning' }}">{{ $record->status }}</span></p>
                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('disposalRecords.edit', $record->id) }}" title="Modifier" style="color: #009082;">
                                    <i class="mdi mdi-pencil" style="font-size: 28px;"></i>
                                </a>
                                <form action="{{ route('disposalRecords.destroy', $record->id) }}" method="POST" style="display:inline;">
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

        <!-- Footer Component -->
        <x-footer />
    </div>

    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        // Function to hide alerts after 3 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.classList.remove('show');
                setTimeout(() => {
                    alert.remove();
                }, 150);
            });
        }, 3000);
    </script>
</body>
</html>
