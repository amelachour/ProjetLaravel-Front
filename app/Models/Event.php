<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'date', 'location'];
     // Ajout des casts
     protected $casts = [
        'date' => 'date', // Vous pouvez aussi utiliser 'datetime' si vous stockez l'heure
    ];

    // Relation avec Participation
    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
}
