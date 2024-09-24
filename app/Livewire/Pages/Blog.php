<?php

namespace App\Livewire\Pages;

use App\Models\Posts;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{   
    use WithPagination;

    public function render()
    {
        $post = Posts::paginate(15);
        return view('livewire.pages.blog',compact('post'));
    }

}
