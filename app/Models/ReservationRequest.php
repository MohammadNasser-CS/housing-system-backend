<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRequest extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function Student()
    {
        return $this->belongsTo(User::class);
    }
    public function HouseOwner()
    {
        return $this->belongsTo(User::class);
    }
    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }
}
