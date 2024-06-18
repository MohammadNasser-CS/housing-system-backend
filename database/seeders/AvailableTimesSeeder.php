<?php

namespace Database\Seeders;

use App\Models\AvailableTimes;
use App\Models\HouseOwner;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailableTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HouseOwner::all()->each(function ($houseOwner) {
            AvailableTimes::factory()->create(['houseOwnerId' => $houseOwner->id]);
        });
    }
}
