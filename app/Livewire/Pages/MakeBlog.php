<?php
namespace App\Livewire\Pages;

use App\Models\Categories;
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
    public $category_id; // Properti untuk kategori

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title' => 'required|string|max:255|unique:posts,title',
        'content' => 'required|string',
        'image' => 'required|max:4093|mimes:avif,jpg,png,jpeg,gif',
        'category_id' => 'required|exists:categories,id', // Validasi kategori
    ];

    public function submit()
    {
        $this->validate();

        try {
            $slug = Str::slug(trim($this->title));

            Posts::create([ 
                'user_id' => auth()->user()->id, // Ambil ID pengguna yang sedang login
                'title' => $this->title,
                'content' => $this->content,
                'slug' => $slug, // Buat slug dari judul
                'published_at' => now(),
                'image' => $this->image->store('images', 'public'),
                'categories_id' => $this->category_id, // Simpan kategori yang dipilih
            ]);

            session()->flash('success', 'Blog post created successfully!');
            return redirect()->to("/{$slug}");
        } catch (\Exception $ex) {
            session()->flash('error', 'Something went wrong: ' . $ex->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.make-blog', [
            'categories' => Categories::all(), // Mengirimkan daftar kategori ke view
        ]);
    }
}

