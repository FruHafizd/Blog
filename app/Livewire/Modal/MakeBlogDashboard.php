<?php

namespace App\Livewire\Modal;

use App\Models\Categories;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Posts;

class MakeBlogDashboard extends Component
{   
    use WithFileUploads;

    public $title;
    public $content;
    public $image;
    public $pin_blog;
    public $slug;
    public $short_description;
    public $category_id; // Properti untuk kategori
    public $categories; 

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title' => 'required|string|max:255|unique:posts,title',
        'content' => 'required|string',
        'short_description' => 'required|string',
        'image' => 'required|max:4093|mimes:avif,jpg,png,jpeg,gif',
        'category_id' => 'required|exists:categories,id', // Validasi kategori
        'slug' => 'required|max:255|unique:posts,slug',
    ];

    public function submit()
    {
        $this->validate();
        try {
            Posts::with('categories')->create([ 
                'user_id' => auth()->user()->id, // Ambil ID pengguna yang sedang login
                'title' => $this->title,
                'content' => $this->content,
                'short_description' => $this->short_description,
                'slug' => $this->slug, // Buat slug dari judul
                'published_at' => now(),
                'image' => $this->image->store('images', 'public'),
                'categories_id' => $this->category_id, // Simpan kategori yang dipilih
                'pin_blog'=> (bool) $this->pin_blog
            ]);
            // session()->flash('success', 'Blog post created successfully!');
            notify()->success('Blog post created successfully!');
            return redirect()->route("dashboard");
        } catch (\Exception $ex) {
            notify()->success('error', 'Something went wrong: ' . $ex->getMessage());
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->slug);
    }

    public function render()
    {
        $posts = Posts::with('categories')->get(); // Eager loading kategori saat mengambil post
        return view('livewire.modal.make-blog-dashboard', [
            'posts' => $posts,
        ]);
    }
    
}
