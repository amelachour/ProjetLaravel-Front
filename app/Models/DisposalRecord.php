<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposalRecord extends Model
{
  protected $fillable = ['waste_id', 'method', 'disposal_date', 'location', 'status'];

  public function waste()
  {
    return $this->belongsTo(Waste::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
