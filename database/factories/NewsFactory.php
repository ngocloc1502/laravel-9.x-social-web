<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(5),
            'image' => fake()->numberBetween(1, 10).".jpg",
            'introduction' => fake()->sentence(10),
            'content' => fake()->text(10000),
            'category_id' => fake()->numberBetween(1, 3),
            'user_id' => fake()->numberBetween(2, 10),
        ];
    }
}
