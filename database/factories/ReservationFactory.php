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
            'userId' => User::factory(),
            'roomId' => Room::factory(),
            'reservationDate' => $this->faker->date,
            'reservationEnd' => $this->faker->date,
            'reservationType' => $this->faker->randomElement(['غرفة', 'تخت']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
