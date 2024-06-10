<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Favorite;
use App\Models\User;
use App\Models\House;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('Type', 'Student')->get();
        $houses = House::all();

        $students->each(function ($student) use ($houses) {
            $house = $houses->random();
            Favorite::factory()->create(['UserId' => $student->id, 'HouseId' => $house->id]);
        });
    }
}
