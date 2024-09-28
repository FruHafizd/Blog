<?php

namespace Database\Factories;

use App\Models\Categories;
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
            'user_id' => User::factory(), // Menggunakan factory untuk user
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'slug' => $this->faker->unique()->slug,
            'published_at' => now(),
            'image' => 'images/hbp1hiWoyWeHs2Lqn1HcMHKEubhJD8mFiCyXRZA4.png', // Sesuaikan dengan path gambar yang ada
            'view_count' => 0,
            'pin_blog' => $this->faker->boolean,
            'categories_id' => Categories::factory(), // Menggunakan factory untuk kategori
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
