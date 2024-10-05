<?php

namespace App\Livewire\Table;

use App\Models\Categories;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Category extends Component
{   
    use WithPagination;

    public $name_category;
    public $editingCategoryId;
    public $editingCategoryName;
    public $search = '';
    protected $queryString = ['search' => ['except' => '']];

    protected $rules = [
        'name_category' => 'required|string|max:255|unique:categories,title',
    ];

    public function addCategory()
    {   
        $this->validate();

        try {
            Categories::create([
                'title' => $this->name_category,
            ]);
            Cache::forget('categories');
            notify()->success('message', 'Category created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create category: ' . $e->getMessage());
            notify()->success('error', 'Failed to create category. Please try again.');
        }
        return redirect()->route('category');
    }

    public function deleteCategory($id)
    {
        try {
            $category = Categories::findOrFail($id);
            $category->delete();
            Cache::forget('categories');
            notify()->info('message', 'Category deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete category: ' . $e->getMessage());
            notify()->info('error', 'Failed to delete the category. Please try again.');
        }
        return redirect()->route('category');
    }
    
    public function render()
    {   
        $categories = Categories::withCount('posts')
            ->where('title', 'like', '%' . $this->search . '%')
            ->paginate(10);
        
        return view('livewire.table.category', compact('categories'));
    }
}
