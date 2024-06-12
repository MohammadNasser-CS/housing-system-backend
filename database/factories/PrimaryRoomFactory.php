<?php

namespace Database\Factories;

use App\Enum\FlagEnum;
use App\Models\PrimaryRoom;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrimaryRoom>
 */
class PrimaryRoomFactory extends Factory
{
    protected $model = PrimaryRoom::class;

    public function definition()
    {
        return [
            'roomId' => Room::factory(),
            'bedNumber' => $this->faker->numberBetween(1, 4),
            'bedNumberBooked' => $this->faker->numberBetween(0, 4),
            'roomSpace' => $this->faker->randomElement(['16', '18', '20']),
            'balcony' => $this->faker->randomElement(array_values(FlagEnum::MAP)),
            'desk' => $this->faker->randomElement(array_values(FlagEnum::MAP)),
            'ac' => $this->faker->randomElement(array_values(FlagEnum::MAP)),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
