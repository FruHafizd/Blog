<?php

namespace App\Livewire\Partials;

use App\Models\Posts;
use Carbon\Carbon;
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


    public function mount(Posts $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->slug = $post->slug;
        $this->pin_blog = (bool) $post->pin_blog;
    }

    public function updateBlog()
    {
        $this->validate([
        'title' => 'required|string|max:255|unique:posts,title,' . $this->post->id,
        'content' => 'required',
        'image' => 'nullable|max:4093|mimes:avif,jpg,png,jpeg,gif',
        'pin_blog' => 'boolean',
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
        ]);

        session()->flash('message', 'Blog updated successfully!');
        return redirect()->route('dashboard'); 
    }
    public function render()
    {
        return view('livewire.partials.update-post-admin');
    }
}
