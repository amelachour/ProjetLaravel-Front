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
        $validated = $request->validate([
            'waste_id' => 'required|exists:wastes,id',
            'method' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
            'location' => 'required|string|regex:/^[a-zA-Z\s]+$/', 
        ], [
            'waste_id.required' => 'Le champ des déchets est obligatoire.',
            'method.required' => 'Le champ méthode d\'élimination est obligatoire.',
            'location.required' => 'Le lieu est obligatoire.',
        ]);
    
        $validated['status'] = 'en attente'; // Default status
        $validated['disposal_date'] = now(); // Set the current date/time for disposal_date
    
        DisposalRecord::create($validated);
    
        return redirect()->route('disposalRecords.index')
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
        $validated = $request->validate([
            'waste_id' => 'required|exists:wastes,id',
            'method' => 'required|string|min:3|regex:/^[a-zA-Z\s]+$/',
            'location' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        ]);

        $disposalRecord = DisposalRecord::findOrFail($id);
        $disposalRecord->update($validated);

        return redirect()->route('disposalRecords.index')
                         ->with('success', 'Enregistrement d’élimination modifié avec succès.');
    }

    public function destroy($id)
    {
        $disposalRecord = DisposalRecord::findOrFail($id);
        $disposalRecord->delete();

        return redirect()->route('disposalRecords.index')
                         ->with('success', 'Enregistrement d’élimination supprimé avec succès.');
    }
}
