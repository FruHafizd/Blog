<?php

namespace App\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{   
    use WithPagination;

    public function render()
    {   
        $users = \App\Models\User::with('roles')->paginate(10);
        return view('livewire.table.user-table',compact('users'));
    }
}
