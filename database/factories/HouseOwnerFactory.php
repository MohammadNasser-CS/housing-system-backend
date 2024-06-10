<?php

namespace Database\Factories;
use App\Models\HouseOwner;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseOwner>
 */
class HouseOwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = HouseOwner::class;
    public function definition(): array
    {
        return [
            'UserId' => User::factory()->houseOwner(),
            'RoyaltyPhoto' => $this->faker->imageUrl,
            'TimesList' => $this->faker->word,
            'DaysList' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
