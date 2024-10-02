<?php

namespace App\Http\Controllers;

use App\Models\RecyclingCenter;
use App\Models\Category;
use Illuminate\Http\Request;

class RecyclingCenterController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('CentreRecyclage.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:6', 
                'regex:/^[a-zA-Z\s]+$/', 
            ],
            'location' => 'required|string|max:255',
           'contact_info' => [
                'required',
                'string',
                'max:255',
                'regex:/^\+216\s\d{2}\s\d{3}\s\d{3}$/', 
            ],
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ], [
            'name.required' => 'Le champ nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.min' => 'Le nom doit contenir au moins 6 caractères.',
            'name.regex' => 'Le nom doit contenir uniquement des lettres.',
            
            'location.required' => 'Le champ emplacement est obligatoire.',
            'location.string' => 'L\'emplacement doit être une chaîne de caractères.',
            
            'contact_info.required' => 'Le champ info de contact est obligatoire.',
            'contact_info.string' => 'Le champ info de contact doit être une chaîne de caractères.',
            'contact_info.regex' => 'Le format du numéro de contact est invalide. Utilisez le format +216 XX XXX XXX.',
    
            'categories.required' => 'Vous devez sélectionner au moins une catégorie.',
            'categories.*.exists' => 'La catégorie sélectionnée est invalide.',
        ]);


        $center = RecyclingCenter::create($validated);
        $center->categories()->attach($validated['categories']);        
        return redirect()->route('CentreRecyclage.categorie')->with('success', 'Centre de recyclage créé avec succès.');
    }

   

   
}
