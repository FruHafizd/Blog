<?php

namespace App\Livewire\Partials;

use App\Models\Posts;
use Livewire\Component;

class ModalDelete extends Component
{
    public $post;

    public function mount($postId)
    {
        $this->post = Posts::findOrFail($postId);
    }

    public function render()
    {
        return view('livewire.partials.modal-delete', ['post' => $this->post]);
    }
}
