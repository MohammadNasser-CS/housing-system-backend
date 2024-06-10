<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'Name' => 'محمد شنطور',
            'Email' => 'shantourm@gmail.com',
            'Password' => Hash::make('12345678'),
            'Phone' => '0527889051',
            'Gender' => 'ذكر',
            'Type' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::factory()->student()->count(10)->create();
        User::factory()->houseOwner()->count(10)->create();

    }
}
