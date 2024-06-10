<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\House;
use App\Models\User;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $houseOwners = User::where('Type', 'HouseOwner')->get();

        $houseOwners->each(function ($houseOwner) {
            House::factory()->create(['UserId' => $houseOwner->id]);
        });
    }
}
