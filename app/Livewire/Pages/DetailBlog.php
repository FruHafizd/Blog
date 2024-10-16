<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Parsedown;

class DetailBlog extends Component
{
    public $slug;
    public $post;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->post = Posts::where('slug', $slug)->first();

        if (!$this->post) {
            abort(404);
        }

        // Parse konten markdown menjadi HTML
        $parsedown = new Parsedown();
        $this->post->content = $parsedown->text($this->post->content);

        // Increment view count
        $this->post->increment('view_count');
    }

    public function destroy(Request $request, $id)
    {
        $post = Posts::findOrFail($id);
    
        // Pastikan pengguna adalah pemilik post
        if (Auth::id() !== $post->user_id  && !Auth::user()->hasRole('Admin')) {
            abort(403);
        }
    
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
        return view('livewire.pages.detail-blog');
    }
}
