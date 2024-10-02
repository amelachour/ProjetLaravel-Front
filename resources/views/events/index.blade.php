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

    h4 {
        text-align: center;
        margin-top: 120px;
        margin-bottom: 1rem;
        color: #333;
        font-weight: bold;
        font-size: 32px; /* Larger title font */
    }

    .table {
        background-color: white; /* Fond de tableau blanc */
        table-layout: fixed; /* Réduit la largeur des lignes */
        width: 100%; /* Utiliser la largeur maximale */
    }

    .table th, .table td {
        vertical-align: middle; /* Center align content */
        font-size: 16px; /* Increase font size */
        padding: 10px; /* Ajout de padding pour aérer les cellules */
    }

    .table thead th {
        background-color: black; /* Bande de titres noire */
        color: white; /* Texte en blanc pour les titres */
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #e9ecef; /* Alternate row colors */
    }
</style>

</head>

<body id="top">

    <!-- Preloader Component -->
    <x-preloader />
    <x-header />

    <div id="page" class="s-pagewrap">
        <section id="waste-list" class="s-content container">
            <h4 class="py-3 mb-4">Liste des Evénements</h4>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom de l'Événement</th>
                            <th scope="col">Date</th>
                            <th scope="col">Lieu</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->date->format('d-m-Y') }}</td>
                                <td>{{ $event->location }}</td>
                                <td>
                                
                                    <form action="" method="POST" class="delete-form" style="display:inline;">
                                        @csrf

                                         <!-- Bouton Participer -->
                                    <a href="{{ route('participants.create', $event->id) }}" class="btn btn-primary" title="Participer">
                                        Participer
                                    </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
