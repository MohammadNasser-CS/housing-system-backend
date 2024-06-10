<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HouseOwner;
use App\Models\User;

class HouseOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $houseOwners = User::where('Type', 'HouseOwner')->get();

        // إنشاء سجلات مالكي المنازل المرتبطة
        $houseOwners->each(function ($houseOwner) {
            HouseOwner::factory()->create(['UserId' => $houseOwner->id]);
        });
    }
}
