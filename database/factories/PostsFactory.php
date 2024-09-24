<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Generate a related user
            'title' => $title = $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'slug' => Str::slug($title),
            'published_at' => now(),
            'image' => $this->faker->imageUrl(640, 480, 'posts', true),
        ];
    }
}
