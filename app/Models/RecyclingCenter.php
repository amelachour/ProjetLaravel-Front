<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecyclingCenter extends Model
{
    protected $fillable = ['name', 'location', 'contact_info'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'center_material');
    }
}
