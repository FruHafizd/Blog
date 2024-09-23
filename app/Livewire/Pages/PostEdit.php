<?php

namespace App\Livewire\Pages;

use App\Models\Posts;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
class PostEdit extends Component
{   
    use WithFileUploads;
    public $title;
    public $content;
    public $image;
    public $postId;
    public $slug;

    
    public function mount($id)
    {   
        $post = Posts::where('id', $id)->first();
        // Memastikan post ditemukan dan pengguna adalah pemiliknya
        if (!$post || Auth::id() !== $post->user_id) {
            abort(code: 403);
        }

        $this->postId = $post->id;  
        $this->title = $post->title;
        $this->content = $post->content;
        $this->image = $post->image;
        $this->slug = $post->slug;
        
    }

    /**
     * Update the event data
     * @return void
     */
    public function update()
    {   
         /**
         * List of add/edit form rules
         */
        $this->validate([
            'title' => 'required|string|max:255|unique:posts,title,' . $this->postId,
            'content' => 'required|string',
            'image' => 'required|image|max:4093',
        ]);
    
        // Buat slug baru dari judul baru
        $newSlug = Str::slug(trim($this->title));
    
        Posts::whereId($this->postId)->update([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $newSlug, // Perbarui slug di sini
            'published_at' => now(),
            'image' => $this->image->store('images', 'public'),
        ]);
    
        session()->flash('success', 'Blog Updated Successfully');
        
        // Redirect ke URL dengan slug baru
        return redirect()->to("/{$newSlug}");
    }
    
    public function render()
    {
        return view('livewire.pages.post-edit');
    }
}
