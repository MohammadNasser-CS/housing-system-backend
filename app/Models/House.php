<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function users()
    {
        return $this->belongsTo(User::class , 'userId');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(Favorite::class);
    }
}
