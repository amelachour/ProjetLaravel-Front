<?php

namespace App\Http\Controllers;
use App\Models\Participant;
use App\Models\Event;
use App\Models\User; 

use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($eventId)
    {
        //
       /* $event = Event::findOrFail($eventId);
        return view('participants.create', compact('event'));*/
        $event = Event::findOrFail($eventId);
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('participants.create', compact('event', 'users','eventId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'user_id' => 'required|exists:users,id', // Utilisation de user_id au lieu de name et email
            'event_id' => 'required|exists:events,id',
        ]);

        // Créer une nouvelle participation
        Participation::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
        ]);

        return redirect()->route('events.index')->with('success', 'Participant ajouté avec succès.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
