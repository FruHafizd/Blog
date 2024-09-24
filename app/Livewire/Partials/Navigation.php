<?php

namespace App\Livewire\Partials;

use App\Models\Posts;
use Livewire\Component;

class Navigation extends Component
{   
    public $search = '';
    protected $queryString = ['search'=> ['except' => '']];

    public $limitPerPage = 10;

    public function postData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {   
        $posts = Posts::latest()->paginate($this->limitPerPage);

        if ($this->search !== null) {
            $posts = Posts::where('title','like', '%' . $this->search . '%')
            ->latest()->paginate($this->limitPerPage);
        }

        return view('livewire.partials.navigation', ['posts' => $posts]);
    }
}
