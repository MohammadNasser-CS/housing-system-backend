<?php

namespace Database\Factories;
use App\Models\Favorite;
use App\Models\User;
use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favorite>
 */
class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {
        return [
            'userId' => User::factory(),
            'houseId' => House::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
