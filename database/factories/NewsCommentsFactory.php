<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsComments>
 */
class NewsCommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->sentence(7),
            'user_id' => fake()->numberBetween(2, 11),
            'news_id' => fake()->numberBetween(1, 30),
        ];
    }
}
