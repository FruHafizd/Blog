<?php

namespace App\Livewire\Table;

use App\Models\Posts;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{   
    use WithPagination;
    
    public function render()
    {   
        // DB::enableQueryLog(); 
        $posts = Posts::with('user')->paginate(10);
        // dd(DB::getQueryLog());
        return view('livewire.table.dashboard',compact('posts'));
    }
}
