<?php

namespace App\Livewire\Partials;

use App\Models\User;
use Livewire\Component;

class ViewUser extends Component
{
    public $user;
    public $roles;
    public $name;
    public $email;
    public $selectedRoles = [];
    
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];
    }

    public function mount(User $user)
    {
        // Mengambil user dengan relasi 'roles' dari model User
        $this->user = \App\Models\User::with('roles')->find($user->id);
        // Mengambil semua roles dari model Role
        $this->roles = \Spatie\Permission\Models\Role::all();
        // Mengisi selectedRoles dengan nama roles yang sudah dimiliki user
        $this->selectedRoles = $this->user->roles->pluck('name')->toArray();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function assignRoles()
    {
        // Sinkronisasi roles yang dipilih dengan user
        $this->user->syncRoles($this->selectedRoles);
        session()->flash('message', 'Roles updated successfully.');
        return redirect()->route('user');
    }

    /**
     * update the User data
     * @return void
     */
    public function update()
    {
        $this->validate();
        try {
            \App\Models\User::whereId($this->user->id)->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            session()->flash('profile-updated', 'Profile User Update Successfully');
            return redirect()->route('user');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy($id)
    {
        try {
            $user = \App\Models\User::findOrFail($id);
            $user->delete();
    
            session()->flash('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete the user.');
        }
        return redirect()->route('user');
    }
    
    public function render()
    {
        return view('livewire.partials.view-user');
    }
}
