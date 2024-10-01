<?php

namespace App\Livewire\Partials;

use App\Models\Categories;
use Livewire\Component;

class ModalUpdateCategory extends Component
{   
    public $categories;
    public $title;

    public function mount(Categories $categories)
    {
        $this->categories = $categories;
        $this->title = $categories->title;
    }

    public function updateCategory()
    {
        $this->validate([
            'title' => 'required|string|max:255|unique:categories,title,' . $this->title,
        ]);
        try {
            $this->categories->update([
                'title' => $this->title
            ]); 
            // session()->flash('message', 'Category updated successfully!');
            notify()->success('message', 'Category updated successfully!');
        } catch (\Exception $e) {
            notify()->success('error', 'Failed to update category. Please try again.');
        }
        return redirect()->route('category');
    }

    public function render()
    {
        return view('livewire.partials.modal-update-category');
    }
}

