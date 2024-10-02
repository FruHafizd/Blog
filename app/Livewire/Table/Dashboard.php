<?php

namespace App\Livewire\Table;

use App\Models\Posts;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{   
    use WithPagination;

    public $search = '';
    protected $queryString = ['search'=> ['except' => '']];
    public $blog_slug; 
    public $limitPerPage = 10;
    
    public function postData()
    {
        $this->limitPerPage = $this->limitPerPage;
    }   

    public function destroy($id)
    {
        dd('Method called');
        // Mengambil post berdasarkan ID
        $post = Posts::findOrFail($id);
        
        // Validasi slug yang dimasukkan
        $this->validate([
            'blog_slug' => 'required|string|in:' . $post->slug,
        ]);

        // Jika validasi berhasil, hapus post
        $post->delete();

        // Set flash message
        notify()->info('Blog Deleted Successfully');
        
        // Kembali ke homepage atau halaman yang diinginkan
        return redirect()->route('dashboard'); 
    }


    public function render()
    {
        // Inisialisasi query dengan relasi user dan categories
        $query = Posts::with(['user', 'categories']);
    
        // Jika ada pencarian, filter berdasarkan title, user name, dan content
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('categories', function($query) {
                        $query->where('title', 'like', '%' . $this->search . '%');
                    });
            });
        }
    
        // Paginasi dan urutkan berdasarkan data terbaru
        $posts = $query->latest()->paginate($this->limitPerPage);
    
        // Mengembalikan view dengan data posts yang sudah difilter
        return view('livewire.table.dashboard', ['posts' => $posts]);
    }
    

}
