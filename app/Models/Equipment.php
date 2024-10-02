<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'purchase_date', 'image_path'];
    protected $dates = ['purchase_date'];
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
