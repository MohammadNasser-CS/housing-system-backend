<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(UserSeder::class);
        $this->call(StudentSeeder::class);
        $this->call(HouseOwnerSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(RoomPhotoSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(FavoriteSeeder::class);
        $this->call(PrimaryRoomSeeder::class);
        $this->call(AvailableTimesSeeder::class);
    }
}
