<?php

namespace App\Livewire\Partials;

use App\Models\Posts;
use Livewire\Component;

class ModalDelete extends Component
{
    public $post;

    public function mount($idPost)
    {
        $this->post = Posts::findOrFail($idPost);
    }

    public function render()
    {
        return view('livewire.partials.modal-delete', ['post' => $this->post]);
    }
}
