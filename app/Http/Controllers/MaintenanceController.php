<?php
namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Equipment;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Afficher toutes les maintenances
    public function index()
    {
        $maintenances = Maintenance::with('equipment')->get(); // Charger les maintenances avec les équipements
        return view('maintenance.index', compact('maintenances'));
    }

    // Afficher le formulaire de création d'une nouvelle maintenance
    public function create()
    {
        $equipments = Equipment::all(); // Charger tous les équipements
        return view('maintenance.create', compact('equipment'));
    }

    // Enregistrer une nouvelle maintenance
    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id', // Vérifiez que l'équipement existe dans la table 'equipment'
            'maintenance_date' => 'required|date|after:today', // Date de maintenance doit être dans le futur
            'details' => 'required|string', // Détails doivent être du texte
        ]);

        Maintenance::create($request->all()); // Créer une nouvelle maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance ajoutée avec succès!');
    }

    // Afficher le formulaire d'édition d'une maintenance
    public function edit(Maintenance $maintenance)
    {
        $equipments = Equipment::all(); // Charger tous les équipements
        return view('maintenance.edit', compact('maintenance', 'equipments'));
    }

    // Mettre à jour une maintenance existante
    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id', // Vérifiez que l'équipement existe dans la table 'equipment'
            'maintenance_date' => 'required|date|after:today', // Date de maintenance doit être dans le futur
            'details' => 'required|string', // Détails doivent être du texte
        ]);

        $maintenance->update($request->all()); // Mettre à jour la maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance mise à jour avec succès!');
    }

    // Afficher les détails d'une maintenance
    public function show(Maintenance $maintenance)
    {
        return view('maintenance.show', compact('maintenance')); // Afficher les détails de la maintenance
    }
    // Supprimer une maintenance
public function destroy(Maintenance $maintenance)
{
    try {
        $maintenance->delete(); // Supprimer la maintenance
        return redirect()->route('maintenance.index')->with('success', 'Maintenance supprimée avec succès!');
    } catch (\Exception $e) {
        return redirect()->route('maintenance.index')->with('error', 'Erreur lors de la suppression de la maintenance : ' . $e->getMessage());
    }
}

}
