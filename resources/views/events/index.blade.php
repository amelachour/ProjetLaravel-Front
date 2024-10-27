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
            background:  #b5d8b7; 
            font-family: 'Arial', sans-serif; 
            color: #333; 
        }

        .s-content {
            margin-top: 80px;
        }

        .header {
            background-color: #4c956c;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        h4 {
            text-align: center;
            margin-top: 20px;
            color: #fff;
            font-weight: bold;
            font-size: 36px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); 
        }

        .card {
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            overflow: hidden;
            max-width: 300px;
            width: 100%;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            color: #4c956c;
        }

        .card-text {
            font-size: 15px;
            color: #666;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #4c956c;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-align: center;
            display: inline-block;
            vertical-align: middle;
            line-height: 35px; 
        }

        .btn-primary:hover {
            background-color: #3a744f;
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover img {
            transform: scale(1.1);
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .row .col-md-3 {
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
</head>

<body id="top">

    <!-- Preloader Component -->
    <x-preloader />
    <x-header />
    </br></br></br></br></br></br></br></br>
    <div id="page" class="s-pagewrap">
        <section id="waste-list" class="s-content container">
            <h4 class="py-3 mb-4">Événements à venir</h4></br>

            <div class="row justify-content-center">
                @foreach($events as $event)
                <div class="col-md-3 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="mdi mdi-calendar"></i> {{ $event->name }}</h5>
                            <p class="card-text"><i class="mdi mdi-calendar-clock"></i> <strong>Date:</strong> {{ $event->date->format('d-m-Y') }}</p>
                            <p class="card-text"><i class="mdi mdi-map-marker"></i> <strong>Lieu:</strong> {{ $event->location }}</p>

                            @if($event->date >= now())
                            <a href="{{ route('participants.create', $event->id) }}" class="btn btn-primary">
                                Participer
                            </a>
                            @else
                            <div class="alert alert-success" role="alert" style="background-color: #e0f4e0; color: #3a774f; border: 2px solid #3a774f; font-size: 14px; padding: 10px; border-radius: 10px;">
                                <i class="mdi mdi-recycle" style="font-size: 24px; color: #3a774f;"></i> <strong>Événement dépassé</strong> <br>
                                Cet événement est terminé, merci pour votre intérêt et continuez à recycler !
                            </div>
                            @endif
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

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Êtes-vous sûr?',
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
