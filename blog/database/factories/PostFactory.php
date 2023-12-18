<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence;
        return [
            'category_id' => rand(1, 10),
            'user_id' => rand(1, 10),
            'tag_id' => rand(1, 10),
            'title' => $title,
            'slug' => Str::slug( $title ),
            'content' => $this->faker->paragraphs(3, true),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
