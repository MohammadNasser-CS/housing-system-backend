<?php

namespace Database\Factories;
use App\Models\Room;
use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Room::class;

    public function definition()
    {
        return [
            'HouseId' => House::factory(),
            'RoomType' => $this->faker->randomElement(['Primary', 'Secondary']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
