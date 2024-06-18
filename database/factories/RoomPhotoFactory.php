<?php

namespace Database\Factories;
use App\Models\RoomPhoto;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomPhoto>
 */
class RoomPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RoomPhoto::class;

    public function definition()
    {
        return [
            'roomId' => Room::factory(),
            'photoUrl' => $this->faker->randomElement(['storage/primartRoomsImages/room1.jpg','storage/primartRoomsImages/room2.jpg','storage/primartRoomsImages/room3.jpg']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
