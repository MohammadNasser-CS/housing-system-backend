<?php

namespace Database\Factories;

use App\Enum\AccountStatusEnum;
use App\Enum\UserGenderEnum;
use App\Enum\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use UserType;

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
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'phoneNumber' => $this->faker->unique()->phoneNumber,
            'role' => $this->faker->randomElement(array_values(UserRoleEnum::MAP)),
            'gender' => $this->faker->randomElement(array_values(UserGenderEnum::MAP)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    public function student()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => UserRoleEnum::STUDENT,
                'accountStatus' => AccountStatusEnum::active,
            ];
        });
    }

    public function houseOwner()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => UserRoleEnum::OWNER,
                'accountStatus' => $this->faker->randomElement(['active', 'Not_Active']),
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
    
}

