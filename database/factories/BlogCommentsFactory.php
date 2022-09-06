<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogComments>
 */
class BlogCommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->sentence(5, false),
            'user_id'=> fake()->numberBetween(1, 10),
            'blog_id'=> fake()->numberBetween(1, 30),
        ];
    }
}
