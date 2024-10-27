


<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecycleMe - Ajouter Participant</title>
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

        h4 {
            text-align: center; /* Align left */
            margin-top: 30px;
            margin-bottom: 1rem;
            color: #333;
            font-weight: bold;
            font-size: 32px; /* Larger title font */
        }
    </style>
</head>

<body id="top">
<x-preloader />
    <x-header />
    </br></br></br></br></br></br></br></br>

    <!-- Section with background image and form -->
    <section id="participant-create" class="s-content container-fluid background-cover">
        <div class="form-container">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">
                    <i class="mdi mdi-plus" aria-hidden="true"></i> Ajouter un Participant à l'Événement: {{ $event->name }}
                </span>
            </h4>
            <form action="{{ route('participants.store') }}" method="POST">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">

                <div class="form-group">
                    <label for="user_id">Sélectionner un Participant</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Choisissez un participant...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter le Participant</button>
            </form>
        </div>
    </section>
    <x-footer />
    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

