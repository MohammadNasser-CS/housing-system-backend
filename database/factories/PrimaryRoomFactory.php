<?php

namespace Database\Factories;
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
            'RoomId' => Room::factory(),
            'BedNumber' => $this->faker->numberBetween(1, 4),
            'BedNumberBooked' => $this->faker->numberBetween(0, 4),
            'RoomSpace' => $this->faker->randomElement(['Small', 'Medium', 'Large']),
            'Balcony' => $this->faker->randomElement(['لا', 'نعم']),
            'Desk' => $this->faker->randomElement(['لا', 'نعم']),
            'AC' => $this->faker->randomElement(['لا', 'نعم']),
            'Price' => $this->faker->randomFloat(2, 100, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
