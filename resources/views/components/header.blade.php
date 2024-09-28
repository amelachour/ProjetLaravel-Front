
<style>
       
       .s-header__nav {
            margin-left: 200px;
        }
        </style>
<header class="s-header">
    <div class="row s-header__inner">
        <div class="s-header__block">
            
            <div class="s-header__logo">
                <a class="logo" href="index.html">
                  
                    <img src="{{ asset('images/logo.png') }}" alt="Homepage">
                </a>
            </div>
            
            <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
        </div>
        <div class="s-header__cta">
            @if(auth()->check())
                
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn--stroke s-header__cta-btn">Déconnecter</button>
                </form>
            @else
                
                <a href="{{ route('login') }}" class="btn btn--stroke s-header__cta-btn">Se Connecter</a>
            @endif
        </div>
        <nav class="s-header__nav ">
    <ul>
       
    <li class="current"><a href="{{ route('home') }}" class="smoothscroll">Accueil</a></li>
        <li><a href="{{ asset('#about') }}" class="smoothscroll">Centres</a></li>
        <li><a href="{{ route('disposalRecords.index') }}">Suivi</a></li>
        <li><a href="{{ route('wastes.index') }}">Déchets</a></li>
        <li><a href="{{ asset('#download') }}" class="smoothscroll">Contactez Nous</a></li>
    </ul>
</nav>


        
    </div>
</header>
