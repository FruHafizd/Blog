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
        // Hapus post jika validasi berhasil
        try {
            // Cari post berdasarkan ID, jika tidak ditemukan, akan mengembalikan 404
            $post = Posts::destroy($id);
            // $post->delete();
            // Set flash message
            notify()->info('Blog Deleted Successfully');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan saat menghapus, bisa memberikan notifikasi error
            notify()->error('Error deleting blog: ' . $e->getMessage());
            return redirect()->back();
        }
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
