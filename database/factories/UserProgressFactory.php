<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProgress>
 */
class UserProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'inform_id' => fake()->numberBetween(1, 15),
            'note' => fake()->sentence(5),
            'status' => fake()->boolean(),
            'created_at' => fake()->dateTimeBetween('now', '+1 week'),
        ];
    }
}
