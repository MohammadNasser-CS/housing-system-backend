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
            'userId' => User::factory()->student(),
            'college' => $this->faker->word,
            'specialization' => $this->faker->word,
            'universityBuilding' => $this->faker->word,
            'birthDate' => $this->faker->date,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
