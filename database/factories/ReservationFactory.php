<?php

namespace Database\Factories;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'UserId' => User::factory(),
            'RoomId' => Room::factory(),
            'ReservationDate' => $this->faker->date,
            'ReservationEnd' => $this->faker->date,
            'ReservationType' => $this->faker->randomElement(['غرفة', 'تخت']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
