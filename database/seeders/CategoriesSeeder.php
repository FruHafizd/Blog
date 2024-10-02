<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Teknologi',
            'Kesehatan',
            'Travel',
            'Gaya Hidup',
            'Bisnis dan Keuangan',
            'Kuliner',
            'Pendidikan',
            'Hiburan'
        ];

        foreach ($categories as $category) {
            Categories::create(['title' => $category]);
        }
    }
}
