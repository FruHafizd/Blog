<?php

namespace App\Livewire\Pages;

use App\Models\Posts;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {   
        $post = Posts::all();
        return view('livewire.pages.home-page',compact('post'));
    }
}
