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

    public $limitPerPage = 10;
    
    public function postData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        $query = Posts::with(['user','categories']);

        // Jika ada pencarian, filter berdasarkan title, name, dan content
        if ($this->search !== null && $this->search !== '') {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                ->orWhereHas('user', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('categories', function($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                })
                ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        // Menggunakan pagination
        $posts = $query->latest()->paginate($this->limitPerPage);

        return view('livewire.table.dashboard', compact('posts'));
    }

}
