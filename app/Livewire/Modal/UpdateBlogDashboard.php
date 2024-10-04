<?php

namespace App\Livewire\Modal;

use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateBlogDashboard extends Component
{   
    use WithFileUploads;

    public $post;
    public $title;
    public $content;
    public $slug;
    public $published_at;
    public $image;
    public $pin_blog;
    public $archived;
    public $category_id;
    public $categories;
    public $short_description;

    public function mount(Posts $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->short_description = $post->short_description;
        $this->slug = $post->slug;
        $this->pin_blog = (bool) $post->pin_blog;
        $this->archived = (bool) $post->archived;

        $this->categories = Categories::all();
        $this->category_id = $post->categories_id;
    }

    public function updateBlog()
    {
        $this->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'short_description' => 'required',
        'image' => 'nullable|max:4093|mimes:avif,jpg,png,jpeg,gif',
        'pin_blog' => 'boolean',
        'archived' => 'boolean',
        'category_id' => 'required|exists:categories,id',
        'slug' => 'required|unique:posts,slug,' . $this->post->id, 
        ]);

        // Handle image upload
        if ($this->image) {
            $imagePath =  $this->image->store('images', 'public');
            $this->post->image = $imagePath;
        }

        // Update post data
        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
            'short_description' => $this->short_description,
            'slug' => $this->slug,
            'pin_blog' => $this->pin_blog,
            'archived' => $this->archived,
            'categories_id' => $this->category_id, 
        ]);

        // session()->flash('message', 'Blog updated successfully!');
        notify()->success('message', 'Blog updated successfully!');
        return redirect()->route('dashboard'); 
    }
    
    public function generateSlug()
    {
        $this->slug = Str::slug($this->slug);
    }

    public function render()
    {
        return view('livewire.modal.update-blog-dashboard');
    }
}
