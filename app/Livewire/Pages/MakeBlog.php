<?php
namespace App\Livewire\Pages;

use App\Models\Categories;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Posts;
use Livewire\WithFileUploads;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;

class MakeBlog extends Component
{   
    use UsesSpamProtection;
    use WithFileUploads;
    public $title;
    public $content;
    public $image;
    public $category_id; // Properti untuk kategori
    public $slug;
    public $short_description;
    
    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'short_description' => 'required|string',
        'image' => 'required|max:4093|mimes:avif,jpg,png,jpeg,gif',
        'category_id' => 'required|exists:categories,id', // Validasi kategori
        'slug' => 'required|unique:posts,slug', 
    ];

    public HoneypotData $extraFields;
    
    public function mount()
    {
        $this->extraFields = new HoneypotData();
    }
    
    public function submit()
    {
        $this->validate();
        $this->protectAgainstSpam(); // if is spam, will abort the request
        try {
            $slug = Str::slug(trim($this->slug));

            Posts::create([ 
                'user_id' => auth()->user()->id, // Ambil ID pengguna yang sedang login
                'title' => $this->title,
                'content' => $this->content,
                'slug' => $slug, // Buat slug dari judul
                'published_at' => now(),
                'image' => $this->image->store('images', 'public'),
                'categories_id' => $this->category_id, // Simpan kategori yang dipilih
                'short_description' => $this->short_description, // Simpan kategori yang dipilih
            ]);

             // Mengatur session dengan tipe dan pesan
            notify()->success('Blog created successfully!');
            return redirect()->to("/{$slug}");
        } catch (\Exception $ex) {
            notify()->warning('message', 'Something went wrong: ' . $ex->getMessage());
        }
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->slug);
    }

    public function render()
    {
        return view('livewire.pages.make-blog', [
            'categories' => Categories::all(), // Mengirimkan daftar kategori ke view
        ]);
    }
}

