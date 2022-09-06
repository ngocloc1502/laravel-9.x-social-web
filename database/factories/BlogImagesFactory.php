<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogImages>
 */
class BlogImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'blog_id' => fake()->numberBetween(1, 30),
            'image' => fake()->numberBetween(1, 10).".jpg",
            'width'=> 360,
            'height'=> 360,
        ];
    }
}
