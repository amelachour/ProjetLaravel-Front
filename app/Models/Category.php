<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function recyclingCenters()
    {
        return $this->belongsToMany(RecyclingCenter::class, 'center_material');
    }
}
