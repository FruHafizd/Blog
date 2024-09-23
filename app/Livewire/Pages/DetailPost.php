<?php

namespace App\Livewire\Pages;

use App\Models\Posts;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DetailPost extends Component
{   
    public $slug;
    public $post;

    public function mount($slug)
    {
        $post = $this->post = Posts::where('slug', $slug)->first();
        // dd($dd);
        $this->slug = $slug;
        if (!$post) {
            abort(code: 404);
        }
    }

    public function destroy(Request $request, $id)
    {
        $post = Posts::findOrFail($id);
    
        // Pastikan pengguna adalah pemilik post
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
    
        // Validasi judul yang dimasukkan
        $request->validate([
            'blog_title' => 'required|string|in:' . $post->title,
        ]);
    
        // Jika validasi berhasil, hapus post
        $post->delete();
        session()->flash('success', 'Blog Deleted Successfully');
        return redirect()->route('homepage'); 
    }
    


    public function render()
    {   
        $post = $this->post;
        return view('livewire.pages.detail-post',compact('post'));  
    }
}
