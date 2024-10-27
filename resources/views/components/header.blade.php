<!-- Add FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    .s-header__nav ul {
        list-style: none;
        display: flex;
        gap: 30px; /* Adjusts the space between menu items */
        margin: 0;
        padding: 0;
    }

    .s-header__nav ul li {
        display: inline-block;
    }

    .s-header__nav a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .s-header__nav a:hover {
        color: #f77a52; /* Color change on hover */
    }

    .s-header__cta {
        display: flex;
        align-items: center;
        gap: 15px; /* Adjust the space between buttons and icons */
    }

    .profile-icon {
        margin-left: 20px;
        font-size: 3rem; /* Increased the size to make the icon larger */
        color: #fff;
        transition: color 0.3s ease;
    }

    .profile-icon:hover {
        color: #f77a52; /* Change the color on hover */
    }

    .s-header__nav ul {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .s-header__nav a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .s-header__nav a:hover {
        color: #f77a52; /* Change the color on hover */
    }

    .s-header__menu-toggle {
        display: none; /* Hide this unless used for mobile */
    }

    /* For mobile responsiveness */
    @media (max-width: 768px) {
        .s-header__nav {
            display: none;
        }

        .s-header__menu-toggle {
            display: block;
        }
    }
</style>

<header class="s-header">
    <div class="row s-header__inner">
        <div class="s-header__block">
            <div class="s-header__logo">
                <a class="logo" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Homepage">
                </a>
            </div>
            <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
        </div>

        <div class="s-header__cta">
            @if(auth()->check())
                <!-- Logout button -->
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn--stroke s-header__cta-btn">Déconnecter</button>
                </form>
            @else
                <!-- Login button -->
                <a href="{{ route('login') }}" class="btn btn--stroke s-header__cta-btn">Se Connecter</a>
            @endif

            @if(auth()->check())
                <!-- Profile icon for authenticated users -->
                <a href="{{ route('profil.profile') }}" class="profile-icon">
                    <i class="fas fa-user-circle"></i> <!-- FontAwesome user icon -->
                </a>
            @endif
        </div>

        <nav class="s-header__nav">
            <ul>
                <li class="current"><a href="{{ route('home') }}" class="smoothscroll">Accueil</a></li>
                <li><a href="{{ route('CentreRecyclage.categorie') }}">Centres</a></li>
                <li><a href="{{ route('disposalRecords.index') }}">Suivi</a></li>
                <li><a href="{{ route('wastes.index') }}">Déchets</a></li>
                <li><a href="{{ route('events.index') }}">Evénements</a></li>
                <li><a href="{{ route('equipment.index') }}">Equipements</a></li>
                <li><a href="{{ route('posts.index') }}" target="_blank">Articles</a></li>
                <li><a href="{{ asset('#download') }}" class="smoothscroll">Contactez Nous</a></li>
            </ul>
        </nav>
    </div>
</header>
