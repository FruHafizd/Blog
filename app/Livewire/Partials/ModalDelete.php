<?php

namespace App\Livewire\Partials;

use App\Models\Posts;
use Illuminate\Http\Client\Request;
use Livewire\Component;

class ModalDelete extends Component
{
    public $post;

    public function mount($idPost)
    {
        $this->post = Posts::findOrFail($idPost);
    }

    public function destroy(Request $request, $id)
    {
        $post = Posts::findOrFail($id);
    
        // Validasi judul yang dimasukkan
        $request->validate([
            'blog_slug' => 'required|string|in:' . $post->slug,
        ]);
    
        // Jika validasi berhasil, hapus post
        $post->delete();
       // Set flash message
        notify()->info('Blog Deleted Successfully');
        return redirect()->route('homepage'); 
    }

    public function render()
    {
        return view('livewire.partials.modal-delete', ['post' => $this->post]);
    }
}
