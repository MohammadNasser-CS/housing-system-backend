<?php

namespace Database\Factories;
use App\Models\House;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = House::class;

    public function definition()
    {
        return [
            'UserId' => User::factory(),
            'Description' => $this->faker->paragraph,
            'Address' => $this->faker->address,
            'HouseType' => $this->faker->randomElement(['شقة', 'أستوديو']),
            'Gender' => $this->faker->randomElement(['أنثى', 'ذكر']),
            'Location' => $this->faker->address,
            'Internet' => $this->faker->randomElement(['لا', 'نعم']),
            'Water' => $this->faker->randomElement(['لا', 'نعم']),
            'Electricity' => $this->faker->randomElement(['لا', 'نعم']),
            'Gaz' => $this->faker->randomElement(['لا', 'نعم']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
