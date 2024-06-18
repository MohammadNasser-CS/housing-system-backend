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
        return $this->belongsTo(User::class , 'studentId');
    }
    public function HouseOwner()
    {
        return $this->belongsTo(User::class , 'houseOwnerId');
    }
    public function rooms()
    {
        return $this->belongsTo(Room::class , 'roomId');
    }
}
