<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoomPhoto;
use App\Models\Room;

class RoomPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();

        $rooms->each(function ($room) {
            RoomPhoto::factory()->count(3)->create(['roomId' => $room->id]);
        });
    }
}
