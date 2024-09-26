<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Livewire\WithPagination;

class PostsPagination extends Component
{
    use WithPagination;

    public $modelClass; // Kelas model yang ingin dipaginate
    public $perPage = 10; // Jumlah item per halaman

    public function mount($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function render()
    {   
        $posts = $this->modelClass::paginate($this->perPage);
        return view('livewire.partials.posts-pagination',[
            'posts' => $posts,
        ]);
    }

    // Metode untuk mengubah jumlah item per halaman
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }
}
