<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableTimes extends Model
{
    use HasFactory;

    protected $fillable = [
        'houseOwnerId',
        'status',
        'timeSlot',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function houseOwner()
    {
        return $this->belongsTo(User::class, 'houseOwnerId');
    }
}
