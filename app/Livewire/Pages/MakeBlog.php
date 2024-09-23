<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Posts;
use Livewire\WithFileUploads;

class MakeBlog extends Component
{   
    use WithFileUploads;
    public $title;
    public $content;
    public $image;

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title' => 'required|string|max:255|unique:posts,title',
        'content' => 'required|string',
        'image' => 'required|image|max:4093',
    ];

    public function submit()
    {
        $this->validate();

        try {
            Posts::create([ // Gunakan model Post
                'user_id' => auth()->user()->id, // Ambil ID pengguna yang sedang login
                'title' => $this->title,
                'content' => $this->content,
                'slug' => Str::slug(trim($this->title)), // Buat slug dari judul
                'published_at' => now(),
                'image' =>  $this->image->store('images', 'public'),
            ]);
    
            // Reset input
            $this->reset(['title', 'content']); // Lebih bersih menggunakan reset

            session()->flash('success', 'Blog post created successfully!');
            return redirect()->route('homepage');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something went wrong: ' . $ex->getMessage()); // Tampilkan pesan kesalahan yang lebih informatif
        }
    }

    public function render()
    {
        return view('livewire.pages.make-blog');
    }
}
