<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecycLab</title>
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body id="top">
<x-preloader />

<div id="page" class="s-pagewrap">
    <x-header /> 

<section id="about" class="s-about target-section">
    <h1 class="title-center">
        Recycling Center Categories 
        <a href="{{ route('CentreRecyclage.create') }}" class="add-category-link" title="Add Center">
            <i class="fas fa-plus-circle" style="color: #70a67c; margin-left: 10px; font-size: 24px;"></i>
        </a>
    </h1>
    <div class="category-cards-container">
        @foreach($categories as $category)
            <div class="category-card">
                <div class="category-card-header">
                    <h2>
                        <a href="{{ route('CentreRecyclage.show', $category->id) }}" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-recycle category-icon"></i> {{ $category->name }}
                        </a>
                    </h2>             
                </div>
            </div>
        @endforeach
    </div>
</section>

<x-footer />
</div>

<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
</body>
</html>
