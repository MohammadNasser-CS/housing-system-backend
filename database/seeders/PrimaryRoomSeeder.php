<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrimaryRoom;
use App\Models\Room;

class PrimaryRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::where('RoomType', 'Primary')->get();

        $rooms->each(function ($room) {
            PrimaryRoom::factory()->create(['RoomId' => $room->id]);
        });
    }
}
