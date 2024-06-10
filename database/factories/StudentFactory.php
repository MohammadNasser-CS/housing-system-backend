<?php

namespace Database\Factories;
use App\Models\Student;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'UserId' => User::factory()->student(),
            'College' => $this->faker->word,
            'Specialization' => $this->faker->word,
            'UniversityBuilding' => $this->faker->word,
            'DateOfBirth' => $this->faker->date,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
