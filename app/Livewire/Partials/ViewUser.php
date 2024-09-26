<?php

namespace App\Livewire\Partials;

use App\Models\User;
use Livewire\Component;

class ViewUser extends Component
{
    public $user;
    public $roles;

    public function mount($user)
    {
        $this->user = \App\Models\User::with('roles')->get();
        $this->user = \App\Models\User::where('id', $user)->first();
        $this->user = $user;
    }


    public function render()
    {
        return view('livewire.partials.view-user');
    }
}
