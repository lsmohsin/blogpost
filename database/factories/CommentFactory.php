<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph,
            'commentable_id' => rand(1, 50), // Assuming 50 posts/users exist
            'commentable_type' => $this->faker->randomElement(['App\Models\Post', 'App\Models\User']),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
