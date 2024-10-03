<?php

namespace App\Livewire\Table;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;
    
    public $search = '';
    protected $queryString = ['search' => ['except' => '']];
    
    public $limitPerPage = 10;

    public function postData()
    {
        $this->limitPerPage += 6; // Menambahkan 6 ke limitPerPage
    }

    public function render()
    {
        // Memulai query untuk User dengan relasi roles
        $query = \App\Models\User::with('roles');

        // Menerapkan pencarian jika ada input
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('roles', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  })
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Mendapatkan data pengguna dengan pagination
        $users = $query->latest()->paginate($this->limitPerPage);

        // Mengembalikan view dengan data pengguna
        return view('livewire.table.user-table', compact('users'));
    }
}
