<?php

namespace Database\Factories;

use App\Enum\FlagEnum;
use App\Models\HouseOwner;
use App\Models\AvailableTimes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AvailableTimes>
 */
class AvailableTimesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AvailableTimes::class;
    public function definition(): array
    {
        $houseOwner = User::factory()->create(['role' => 'صاحب سكن']);

        return [
            'houseOwnerId' => HouseOwner::factory(),
            'status' => $this->faker->randomElement(array_values(FlagEnum::MAP)),
            'timeSlot' => $this->faker->randomElement([
                'الأحد: 8-9',
                'الأحد: 9-10',
                'الأحد: 10-11',
                'الأحد: 1-2',
                'الأحد: 2-3',
            ]),
        ];
    }
}
