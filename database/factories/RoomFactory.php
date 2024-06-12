<?php

namespace Database\Factories;

use App\Enum\RoomTypeEnum;
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
            'houseId' => House::factory(),
            'roomType' => $this->faker->randomElement(array_values(RoomTypeEnum::MAP)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
