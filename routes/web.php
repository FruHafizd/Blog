<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Livewire\Pages\Blog;
use App\Livewire\Pages\DetailPost;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\MakeBlog;
use App\Livewire\Pages\PostEdit;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckBanned; // Import the middleware

Route::get('/', HomePage::class)->name('homepage');
Route::get('/blog', Blog::class)->name('blog');


// Group route yang memerlukan autentikasi
Route::middleware(['auth','banned'])->group(function () { // Apply CheckBanned here
    
    Route::middleware('role:Admin')->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/user', function () {
            return view('user');
        })->name('user');

        Route::get('/category', function () {
            return view('category');
        })->name('category');
        
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/make-blog', MakeBlog::class)->name('blog.create');
    Route::get('/edit/blog/{id}', PostEdit::class)->middleware(['post.owner'])->name('blog.edit');
    Route::delete('/edit/blog/{id}', [DetailPost::class, 'destroy'])->name('blog.delete');
});

// Route autentikasi
require __DIR__.'/auth.php';

// Route dinamis
Route::get('/{slug}', DetailPost::class)->name('blog.detail');


// Route Google

// Untuk redirect ke Google
Route::get('login/google/redirect', [SocialiteController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect');

// Untuk callback dari Google
Route::get('login/google/callback', [SocialiteController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback');

