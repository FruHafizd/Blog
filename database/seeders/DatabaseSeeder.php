<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Posts;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // User::factory(10)->create();
        // Posts::factory()->count(10)->create();
        Categories::factory()->create();

        $this->call(RoleAndPermissionSeeder::class);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        $user = User::first();
        $user->assignRole('Admin');
        $this->call([
            CategoriesSeeder::class,
            PostSeeder::class
        ]);
    }
}
