<?php

namespace App\Livewire\Pages;

use App\Models\Posts;
use App\Models\Categories;
use Livewire\Component;
use Livewire\WithPagination;

class LatestBlog extends Component
{   
    use WithPagination;
    
    public $selectedCategory = '';
    public $perPage = 12;

    protected $queryString = ['selectedCategory'];


    public function render()
    {   
        $post = Posts::where('archived', false)->latest()->when($this->selectedCategory, function ($query) {
            return $query->where('categories_id', $this->selectedCategory);
        })->paginate($this->perPage);

        $categories = Categories::all();

        return view('livewire.pages.latest-blog',[
            'post' => $post,
            'categories' => $categories,
        ]);
    }
}
