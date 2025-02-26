<?php

namespace App\Livewire\Pages;

use App\Models\Posts;
use App\Models\Categories;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;
    
    public $selectedCategory = '';
    public $perPage = 12;

    protected $queryString = ['selectedCategory'];

    public function render()
    {
        $post = Posts::with('categories')->where('archived', false)->when($this->selectedCategory, function ($query) {
            return $query->where('categories_id', $this->selectedCategory);
        })->paginate($this->perPage);

        $categories = Categories::all();

        return view('livewire.pages.blog', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }
}