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
            'userId' => User::factory()->houseOwner(),
            'royaltyPhoto' => $this->faker->imageUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
