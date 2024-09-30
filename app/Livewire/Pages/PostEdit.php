<?php

namespace App\Livewire\Pages;

use App\Models\Categories;
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
    public $category_id;
    public $categories;
    
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
        $this->image = null;
        $this->slug = $post->slug;

        $this->categories = Categories::all();
        $this->category_id = $post->categories_id;
        
    }
    
    /**
     * Update the event data
     * @return void
     */
    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|max:4093|mimes:avif,jpg,png,jpeg,gif',
            'category_id' => 'required|exists:categories,id', 
            'slug' => 'required|unique:posts,slug,' . $this->postId, 
        ]);

        $newSlug = Str::slug(trim($this->slug));

        $post = Posts::find($this->postId);
        $post->title = $this->title;
        $post->content = $this->content;
        $post->slug = $newSlug;
        $post->published_at = now();
        $post->categories_id = $this->category_id;
        // Hanya simpan gambar baru jika diupload
        if ($this->image) {
            $post->image = $this->image->store('images', 'public');
        }

        $post->save();

        session()->flash('success', 'Blog Updated Successfully');

        return redirect()->to("/{$newSlug}");
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->slug);
    }
    
    public function render()
    {
        $post = Posts::find($this->postId); // Ambil objek post berdasarkan ID
        
        return view('livewire.pages.post-edit', compact('post'));
    }

}
