<?php

namespace App\Livewire\Partials;

use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdatePostAdmin extends Component
{   
    use WithFileUploads;

    public $post;
    public $title;
    public $content;
    public $slug;
    public $published_at;
    public $image;
    public $pin_blog;
    public $category_id;
    public $categories;


    public function mount(Posts $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->slug = $post->slug;
        $this->pin_blog = (bool) $post->pin_blog;

        $this->categories = Categories::all();
        $this->category_id = $post->categories_id;
    }

    public function updateBlog()
    {
        $this->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|max:4093|mimes:avif,jpg,png,jpeg,gif',
        'pin_blog' => 'boolean',
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
            'slug' => $this->slug,
            'pin_blog' => $this->pin_blog,
            'categories_id' => $this->category_id, 
        ]);

        session()->flash('message', 'Blog updated successfully!');
        return redirect()->route('dashboard'); 
    }
    
    public function generateSlug()
    {
        $this->slug = Str::slug($this->slug);
    }
    
    public function render()
    {   
        return view('livewire.partials.update-post-admin');
    }
}
