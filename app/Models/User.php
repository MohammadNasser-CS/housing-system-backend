<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded =[];
    protected $hidden = [
        'password',
        'gender',
        'accountStatus',
        'created_at',
        'updated_at',
    ];
    //realtions :
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function houseOwner()
    {
        return $this->hasOne(HouseOwner::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function reservationRequest()
    {
        return $this->hasMany(ReservationRequest::class);
    }
    /*public function reservationRequestStudents()
    {
        return $this->hasMany(ReservationRequest::class);
    }
    public function reservationRequestHouseOwners()
    {
        return $this->hasMany(ReservationRequest::class);
    }*/
    public function houses()
    {
        return $this->hasMany(House::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(Favorite::class);
    }
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }

}
