<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MSession>
 */
class MSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'lat' => $this->faker->latitude($min = -90, $max = 90),
            'long' => $this->faker->longitude($min = -180, $max = 180),
            'user_agent' => $this->faker->chrome()
        ];
    }
}
