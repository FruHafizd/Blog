<?php

namespace App\Livewire\Modal;

use App\Models\Posts;
use Livewire\Component;

class ViewBlogDashboard extends Component
{   
    public $post;
    public function mount($postId)
    {
        $this->post = Posts::findOrFail($postId);
    }

    public function render()
    {
        return view('livewire.modal.view-blog-dashboard');
    }
}
