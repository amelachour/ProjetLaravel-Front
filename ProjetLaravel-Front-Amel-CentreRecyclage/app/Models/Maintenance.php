<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = ['equipment_id', 'maintenance_date', 'details'];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}