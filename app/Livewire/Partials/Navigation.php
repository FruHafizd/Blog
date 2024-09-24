<?php

namespace App\Livewire\Partials;

use App\Models\Posts;
use Livewire\Component;

class Navigation extends Component
{   
    public $searchTerm = '';
    public $searchResults = [];

    public function performSearch()
    {
        // Perform your search logic here
        // For example, fetching results from the database:
        $this->searchResults = Posts::where('title', 'like', '%' . $this->searchTerm . '%')->get();
    }

    public function render()
    {
        return view('livewire.partials.navigation');
    }
}
