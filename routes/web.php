<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\DetailPost;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\MakeBlog;
use App\Livewire\Pages\PostEdit;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', HomePage::class)->name('homepage');

// Group route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/make/blog', MakeBlog::class)->name('blog.create');
    // Route::get('/edit/blog/{slug}', PostEdit::class)->name('blog.edit');

    Route::get('/edit/blog/{id}',
        PostEdit::class
    )->middleware(['post.owner'])->name('blog.edit');

    Route::delete('/edit/blog/{id}', [DetailPost::class, 'destroy'])->name('blog.delete');

});

// Route autentikasi
require __DIR__.'/auth.php';

// Route dinamis
Route::get('/{slug}', DetailPost::class)->name('blog.detail');

