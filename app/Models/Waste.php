<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
  protected $fillable = ['type', 'weight', 'created_at', 'user_id', 'status'];

  public function disposalRecords()
  {
    return $this->hasMany(DisposalRecord::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
