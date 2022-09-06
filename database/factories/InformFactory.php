<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inform>
 */
class InformFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'messages' => fake()->sentence(6),
            'user_id'=> fake()->numberBetween(2, 11),
            'deadline' => fake()->dateTimeBetween('+1 week', '+2 week'),
        ];
    }
}
