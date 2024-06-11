<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;


class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'طالب')->get();
        $rooms = Room::all();

        $users->each(function ($user) use ($rooms) {
            $room = $rooms->random();
            Reservation::factory()->create(['userId' => $user->id, 'roomId' => $room->id]);
        });
    }
}
