<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function houses()
    {
        return $this->belongsTo(House::class,'houseId');
    }
    public function primaryRooms()
    {
        return $this->hasOne(primaryRoom::class,'roomId');
    }
    public function roomphotos()
    {
        return $this->hasMany(RoomPhoto::class ,'roomId');
    }
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
    public function reservationRequests(){
        return $this->belongsTo(ReservationRequest::class);
    }
}
