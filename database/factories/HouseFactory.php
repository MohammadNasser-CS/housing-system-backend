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
            'userId' => User::factory(),
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'houseType' => $this->faker->randomElement(['شقة', 'أستوديو']),
            'gender' => $this->faker->randomElement(['أنثى', 'ذكر']),
            'location' => $this->faker->address,
            'internet' => $this->faker->randomElement(['لا', 'نعم']),
            'water' => $this->faker->randomElement(['لا', 'نعم']),
            'electricity' => $this->faker->randomElement(['لا', 'نعم']),
            'gas' => $this->faker->randomElement(['لا', 'نعم']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
