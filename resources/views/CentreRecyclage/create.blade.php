<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecycLab</title>
    <link rel="stylesheet" href="../css/vendor.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
       body {
            background-color: #f4f4f4; 
            font-family: Arial, sans-serif; 
        }

        .s-about {
            max-width: 600px;
            margin: 50px auto; 
            padding: 20px; 
            background: white;
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

        h1 {
            text-align: center; 
            margin-bottom: 20px; 
        }

        label {
            display: block; 
            margin-bottom: 5px; 
            font-weight: bold; 
        }

        input[type="text"], select {
            width: 100%; 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }

        button {
            width: 100%;
            padding: 10px; 
            background-color: #28a745; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            font-size: 16px; 
            cursor: pointer; 
        }

        button:hover {
            background-color: #218838;
        }


        .text-danger {
        color: red;
        font-size: 0.9em; 
    }
    </style>
</head>

<body id="top">
    <x-preloader />

    <div id="page" class="s-pagewrap">
        <x-header
         />

                        <div id="about" class="s-about target-section">
                            <h1>Add a New Recycling Center</h1>
                            
                            <form action="{{ route('CentreRecyclage.store') }}" method="POST">
                                @csrf
                            <!-- Champ Name -->
                    <div>
                        <label for="name">Nom:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <!-- Champ Location -->
                    <div>
                        <label for="location">Emplacement:</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" required>
                        @if ($errors->has('location'))
                            <span class="text-danger">{{ $errors->first('location') }}</span>
                        @endif
                    </div>

                    <!-- Champ Contact Info -->
                    <div>
                        <label for="contact_info">Info de contact:</label>
                        <input type="text" id="contact_info" name="contact_info" value="{{ old('contact_info') }}" required>
                        @if ($errors->has('contact_info'))
                            <span class="text-danger">{{ $errors->first('contact_info') }}</span>
                        @endif
                    </div>

                    <!-- Champ Categories -->
                    <div>
                        <label for="categories">Catégories:</label>
                        <select id="categories" name="categories[]" multiple required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('categories'))
                            <span class="text-danger">{{ $errors->first('categories') }}</span>
                        @endif
                    </div>
                <button type="submit">Add Center</button>
            </form>
        </div>

        <x-footer />
    </div>  

    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
