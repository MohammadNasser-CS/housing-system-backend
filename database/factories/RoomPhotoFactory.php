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
            'RoomId' => Room::factory(),
            'PhotoUrl' => $this->faker->imageUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
