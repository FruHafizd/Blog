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

    public function deleteBlog($id)
    {
        try {
            $post = Posts::findOrFail($id);
            $post->delete();
    
            notify()->info('message', 'Blog deleted successfully!');
        } catch (\Exception $e) {
            notify()->info('error', 'Failed to delete the Blog. Please try again.');
        }
        return redirect()->route('dashboard');
    }
    

    public function render()
    {   
        // Paginasi dan urutkan berdasarkan data terbaru
        $query = Posts::with('user', 'categories');  

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

        $posts = $query->latest()->paginate(15);
        // Mengembalikan view dengan data posts yang sudah difilter
        return view('livewire.table.dashboard', compact('posts'));
    }
    

}
