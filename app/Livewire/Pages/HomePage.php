<?php

namespace App\Livewire\Pages;

use App\Models\Categories;
use App\Models\Posts;
use Livewire\Component;

class HomePage extends Component
{   
    public function render()
    {   
        $post = Posts::where('archived', false)->latest()->take(6)->get();
        $mostReadPosts = Posts::where('archived', false)->orderBy('view_count', 'desc')->take(6)->get();
        $pinBlog = Posts::where('archived', false)->where('pin_blog', 1)->take(2)->get();
        // $categories = Categories::all(); // Ambil semua kategori
        return view('livewire.pages.home-page', compact('post', 'mostReadPosts', 'pinBlog'));
    }
    
}
