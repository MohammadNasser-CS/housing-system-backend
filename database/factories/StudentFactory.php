<?php

namespace Database\Factories;

use App\Enum\CollegesEnum;
use App\Enum\SpecializationsEnum;
use App\Enum\UniversityBuildingsEnum;
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
            'college' => $this->faker->randomElement(array_values(CollegesEnum::MAP)),
            'specialization' => $this->faker->randomElement(array_values(SpecializationsEnum::MAP)),
            'universityBuilding' => $this->faker->randomElement(array_values(UniversityBuildingsEnum::MAP)),
            'birthDate' => $this->faker->date,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
