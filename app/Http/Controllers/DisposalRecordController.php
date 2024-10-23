<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisposalRecord;
use App\Models\Waste;

class DisposalRecordController extends Controller
{
  public function index()
  {
      $user = auth()->user();
      $wasteIds = Waste::where('user_id', $user->id)->pluck('id'); 
  
      $disposalRecords = DisposalRecord::with('waste')
          ->whereIn('waste_id', $wasteIds) 
          ->get();
  
      return view('disposalRecords.index', compact('disposalRecords'));
  }
  
  

  public function create()
  {
      $user = auth()->user(); 
      $wastes = Waste::where('user_id', $user->id)->get(); 
  
      return view('disposalRecords.create', compact('wastes'));
  }

  public function store(Request $request)
  {
      $validated = $request->validate(
          [
              'waste_id' => 'required|exists:wastes,id',
              'method' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
              'disposal_date' => 'required|date|after_or_equal:today',
              'location' => 'required|string|regex:/^[a-zA-Z\s]+$/', 
          ],
          [
              'waste_id.required' => 'Le champ des déchets est obligatoire.',
              'waste_id.exists' => 'Le déchet sélectionné est invalide.',
              'method.required' => 'Le champ méthode d\'élimination est obligatoire.',
              'method.string' => 'La méthode d\'élimination doit être une chaîne de caractères.',
              'method.min' => 'La méthode d\'élimination doit comporter au moins 3 caractères.',
              'method.regex' => 'La méthode d\'élimination doit contenir uniquement des lettres.',
              'disposal_date.required' => 'La date d\'élimination est obligatoire.',
              'disposal_date.date' => 'La date d\'élimination doit être une date valide.',
              'disposal_date.after_or_equal' => 'La date d\'élimination doit être aujourd\'hui ou dans le futur.',
              'location.required' => 'Le lieu est obligatoire.',
              'location.string' => 'Le lieu doit être une chaîne de caractères.',
              'location.regex' => 'Le lieu doit contenir uniquement des lettres et des espaces.',
          ]
      );
  
      DisposalRecord::create($validated);
  
      return redirect()
          ->route('disposalRecords.index')
          ->with('success', 'Enregistrement d\'élimination ajouté avec succès.');
  }
  

  public function edit($id)
  {
      $disposalRecord = DisposalRecord::findOrFail($id);
      $user = auth()->user(); 
      $wastes = Waste::where('user_id', $user->id)->get(); 
  
      return view('disposalRecords.edit', compact('disposalRecord', 'wastes'));
  }
  

  public function update(Request $request, $id)
  {
      $validated = $request->validate(
          [
              'waste_id' => 'required|exists:wastes,id',
              'method' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
              'disposal_date' => 'required|date|after_or_equal:today',
              'location' => 'required|string|regex:/^[a-zA-Z\s]+$/',
          ],
          [
              'waste_id.required' => 'Le champ des déchets est obligatoire.',
              'waste_id.exists' => 'Le déchet sélectionné est invalide.',
              'method.required' => 'Le champ méthode d\'élimination est obligatoire.',
              'method.string' => 'La méthode d\'élimination doit être une chaîne de caractères.',
              'method.min' => 'La méthode d\'élimination doit comporter au moins 3 caractères.',
              'method.regex' => 'La méthode d\'élimination doit contenir uniquement des lettres.',
              'disposal_date.required' => 'La date d\'élimination est obligatoire.',
              'disposal_date.date' => 'La date d\'élimination doit être une date valide.',
              'disposal_date.after_or_equal' => 'La date d\'élimination doit être aujourd\'hui ou dans le futur.',
              'location.required' => 'Le lieu est obligatoire.',
              'location.string' => 'Le lieu doit être une chaîne de caractères.',
              'location.regex' => 'Le lieu doit contenir uniquement des lettres et des espaces.',
          ]
      );
  
      $disposalRecord = DisposalRecord::findOrFail($id);
      $disposalRecord->update($validated);
  
      return redirect()
          ->route('disposalRecords.index')
          ->with('success', 'Enregistrement d’élimination modifié avec succès.');
  }
  public function destroy($id)
  {
    $disposalRecord = DisposalRecord::findOrFail($id);
    $disposalRecord->delete();
    return redirect()
      ->route('disposalRecords.index')
      ->with('success', 'Enregistrement d’élimination supprimé avec succès.');
  }
}
