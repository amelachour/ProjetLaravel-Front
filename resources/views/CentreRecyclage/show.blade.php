<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecycLab</title>
    <link rel="stylesheet" href="../css/vendor.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body id="top">
<x-preloader />

<div id="page" class="s-pagewrap">
    <x-header />    
    
    <section id="about" class="s-about target-section">
        <h2 class="title-center">Centres de Recyclage Associés</h2>

        <div class="category-cards-containerr"> 
            @if($centers->isNotEmpty())
                @foreach($centers as $center)
                    <div class="category-card"> 
                        <div class="category-card-header">
                            <h3>
                                <a href="#" style="text-decoration: none; color: inherit;">
                                    <strong>{{ $center->name }}</strong>
                                </a>
                            </h3>
                            <div class="category-card-body">
                                <p><i class="fas fa-map-marker-alt"></i> Location: {{ $center->location }}</p>
                                <p><i class="fas fa-phone"></i> Contact: {{ $center->contact_info }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <br>Aucun centre de recyclage trouvé pour cette catégorie.</br>
            @endif
        </div>
    </section>

    <x-footer />
</div>

<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
</body>
</html>
