<?php

namespace App\Livewire\Pages;

use App\Models\Categories;
use App\Models\Posts;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 

class BlogEdit extends Component
{   
    use WithFileUploads;
    public $title;
    public $content;
    public $image;
    public $dbphoto;
    public $postId;
    public $slug;
    public $category_id;
    public $categories;
    public $short_description;
    public $post;

    public function mount($id)
    {   
        // Temukan post berdasarkan ID
        $post = Posts::find($id);
    
        // Memastikan post ditemukan dan pengguna adalah pemiliknya atau admin
        if (!$post || (Auth::id() !== $post->user_id && !Auth::user()->hasRole('Admin'))) {
            abort(403);
        }
    
        // Inisialisasi properti untuk form
        $this->postId = $post->id;  
        $this->title = $post->title;
        $this->content = $post->content;
    
        // Dapatkan URL gambar dari penyimpanan lokal
        $this->dbphoto = $post->image 
            ? asset('storage/' . $post->image)  // Gunakan asset() untuk mendapatkan URL gambar di penyimpanan lokal
            : '';
    
        $this->slug = $post->slug;
        $this->short_description = $post->short_description;
    
        // Ambil semua kategori dan set kategori dari post
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
        $post->short_description = $this->short_description;
        // Hanya simpan gambar baru jika diupload
        if ($this->image) {
            $post->image = $this->image->store('images', 'public');
        }

        $post->save();

        // session()->flash('success', 'Blog Updated Successfully');
        notify()->success('Blog Updated Successfully');
        return redirect()->to("/{$newSlug}");
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->slug);
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.pages.blog-edit');
    }
}
