<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - RecycleMe</title>

    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }

        .navbar {
            background-color: #4caf50;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar img {
            height: 70px; /* Augmenter la hauteur du logo */
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            position: relative; /* For hover underline effect */
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .navbar .dropdown {
            position: relative;
            display: inline-block;
        }

        .navbar .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .navbar .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .navbar .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .navbar .dropdown:hover .dropdown-content {
            display: block;
        }

        .profile-container {
            max-width: 900px;
            margin: 20px auto; /* Reduced margin for better spacing */
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #4caf50;
        }

        .profile-header h2 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }

        .profile-header p {
            margin: 0;
            color: #777;
        }

        .profile-details {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .profile-info, .profile-edit {
            width: 48%;
        }

        .profile-info h3, .profile-edit h3 {
            font-size: 22px;
            color: #4caf50;
            margin-bottom: 15px;
            border-bottom: 2px solid #4caf50;
            padding-bottom: 10px;
        }

        .profile-info p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #555;
        }

        .profile-edit input, .profile-edit textarea, .profile-edit select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile-edit button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-edit button:hover {
            background-color: #43a047;
        }
    </style>
</head>

<body id="top">
    <!-- Navbar Section -->
    <div class="navbar">
        <img src="{{ asset('images/logo.png') }}" alt="RecycleMe Logo">
        <div>
            <a href="{{ route('home') }}">Home</a>
            
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">Logout</button>
</form>
        </div>
    </div>

    <div class="profile-container">
        <!-- Profile Header Section -->
        <div class="profile-header">
        @if (Auth::check() && Auth::user()->profile)
    <img src="{{ Auth::user()->profile->profile_picture ? asset('storage/' . Auth::user()->profile->profile_picture) : asset('images/profile-placeholder.jpg') }}" alt="User Profile Picture">
@else
    <img src="{{ asset('images/profile-placeholder.jpg') }}" alt="User Profile Picture">
@endif
            <div>
                <h2>{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- Profile Details Section -->
        <div class="profile-details">
            <!-- Personal Information -->
            <div class="profile-info">
                <h3>Personal Information</h3>
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Phone Number:</strong> {{ Auth::user()->profile->phone_number ?? 'Not set' }}</p>
                <p><strong>Address:</strong> {{ Auth::user()->profile->address ?? 'Not set' }}</p>
                <p><strong>Birthdate:</strong> {{ Auth::user()->profile->birthdate ?? 'Not set' }}</p>
                <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
            </div>

            <!-- Edit Profile -->
            <div class="profile-edit">
                <h3>Edit Profile</h3>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>

                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ Auth::user()->profile->phone_number ?? '' }}" required>

                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="3">{{ Auth::user()->profile->address ?? '' }}</textarea>

                    <label for="birthdate">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" value="{{ Auth::user()->profile->birthdate ?? '' }}">

                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
