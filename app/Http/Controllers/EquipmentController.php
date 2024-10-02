<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the equipment.
     */
    public function index()
    {
        $equipments = Equipment::all();
        
        // Log de débogage
        
        return view('equipment.index', compact('equipments'));
    }
    
    /**
     * Display the specified equipment and its associated maintenance records.
     */
    public function show($id)
    {
        $equipment = Equipment::findOrFail($id);
        $maintenances = $equipment->maintenances; 
        return view('equipment.show', compact('equipment', 'maintenances'));
    }
}
