<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                'Teknologi',
                'Kesehatan',
                'Travel',
                'Gaya Hidup',
                'Bisnis dan Keuangan',
                'Kuliner',
                'Pendidikan',
                'Hiburan'
            ]),
        ];
    }
}
