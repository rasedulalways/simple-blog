<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::get()->random()->id,
            'post_id' => \App\Models\Post::get()->random()->id,
            'parent_id' => rand(1, 10),
            'comment' => $this->faker->paragraph(1),
            'status' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
