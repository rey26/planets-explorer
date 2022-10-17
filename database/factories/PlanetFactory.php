<?php

namespace Database\Factories;

use App\Models\GravityStandard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planet>
 */
class PlanetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'diameter' => $this->faker->numberBetween(5000, 15000),
            'rotation_period' => $this->faker->numberBetween(20, 30),
        ];
    }
}
