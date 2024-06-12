<?php

namespace Database\Factories;

use App\Enum\FlagEnum;
use App\Enum\HouseTypeEnum;
use App\Enum\UserGenderEnum;
use App\Models\House;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = House::class;

    public function definition()
    {
        return [
            'userId' => User::factory(),
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'houseType' => $this->faker->randomElement(array_values(HouseTypeEnum::MAP)),
            'gender' => $this->faker->randomElement(array_values(UserGenderEnum::MAP)),
            'location' => $this->faker->address,
            'internet' => $this->faker->randomElement(array_values(FlagEnum::MAP)),
            'water' => $this->faker->randomElement(array_values(FlagEnum::MAP)),
            'electricity' => $this->faker->randomElement(array_values(FlagEnum::MAP)),
            'gas' => $this->faker->randomElement(array_values(FlagEnum::MAP)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
