<?php

namespace App\Livewire\Pages;

use App\Models\Posts;
use Livewire\Component;

class HomePage extends Component
{   
    public function render()
    {   
        $post = Posts::latest()->take(6)->get();
        $mostReadPosts = Posts::orderBy('view_count', 'desc')->take(6)->get();
        $pinBlog = Posts::orderBy('view_count', 'desc')->take(6)->get();
        return view('livewire.pages.home-page',compact('post','mostReadPosts'));
    }
}
