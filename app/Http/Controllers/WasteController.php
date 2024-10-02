<?php

namespace App\Http\Controllers;

use App\Models\Waste;
use Illuminate\Http\Request;

class WasteController extends Controller
{
  public function index()
  {
     
      $wastes = Waste::where('user_id', auth()->id())->get();
      
      return view('wastes.index', compact('wastes'));
  }
  

  public function create()
  {
    return view('wastes.create');
  }

  public function store(Request $request)
  {
    $request->validate(
      [
        'type' => 'required',
        'weight' => 'required|numeric',
      ],
      [
        'type.required' => 'Le type est obligatoire.',
        'weight.required' => 'Le poids est obligatoire.',
        'weight.numeric' => 'Le poids doit être un nombre.',
      ]
    );

    Waste::create([
      'type' => $request->type,
      'weight' => $request->weight,
      'user_id' => auth()->id(), 
  ]);

    return redirect()
      ->route('wastes.index')
      ->with('success', 'Déchet ajouté avec succès.');
  }

  public function show(string $id)
  {
    //
  }

  public function edit($id)
  {
      $waste = Waste::findOrFail($id);
  
     
      if ($waste->user_id !== auth()->id()) {
          return redirect()->route('wastes.index')->withErrors('Vous n\'êtes pas autorisé à modifier ce déchet.');
      }
  
      return view('wastes.edit', compact('waste'));
  }
  

  public function update(Request $request, $id)
  {
      $waste = Waste::findOrFail($id);
  
     
      if ($waste->user_id !== auth()->id()) {
          return redirect()->route('wastes.index')->withErrors('Vous n\'êtes pas autorisé à modifier ce déchet.');
      }
  
      $validatedData = $request->validate(
        [
          'type' => 'required|string|max:255',
          'weight' => 'required|numeric|min:0',
        ],
        [
          'type.required' => 'Le type est obligatoire.',
          'weight.required' => 'Le poids est obligatoire.',
          'weight.numeric' => 'Le poids doit être un nombre.',
          'weight.min' => 'Le poids doit être supérieur ou égal à zéro.',
        ]
      );
  
      $waste->update($validatedData);
  
      return redirect()
        ->route('wastes.index')
        ->with('success', 'Déchet modifié avec succès.');
  }
  

  public function destroy($id)
  {
      $waste = Waste::findOrFail($id);
  
     
      if ($waste->user_id !== auth()->id()) {
          return redirect()->route('wastes.index')->withErrors('Vous n\'êtes pas autorisé à supprimer ce déchet.');
      }
  
      $waste->delete();
  
      return redirect()
        ->route('wastes.index')
        ->with('success', 'Déchet supprimé avec succès.');
  }
  
}
