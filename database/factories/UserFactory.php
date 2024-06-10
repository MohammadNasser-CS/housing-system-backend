<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name,
            'Email' => $this->faker->unique()->safeEmail,
            'Password' => bcrypt('password'),
            'Phone' => $this->faker->unique()->phoneNumber,
            'Type' => $this->faker->randomElement(['Student', 'HouseOwner']),
            'Gender' => $this->faker->randomElement(['ذكر', 'أنثى']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    public function student()
    {
        return $this->state(function (array $attributes) {
            return [
                'Type' => 'Student',
                'AccountStatus' => 'Active',
            ];
        });
    }

    public function houseOwner()
    {
        return $this->state(function (array $attributes) {
            return [
                'Type' => 'HouseOwner',
                'AccountStatus' => $this->faker->randomElement(['Active', 'Not_Active']),
            ];
        });
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(
            fn(array $attributes) => [
                'email_verified_at' => null,
            ],
        );
    }
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->createToken('default_token');
        });
    }
}

