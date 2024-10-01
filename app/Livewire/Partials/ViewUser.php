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
    public $banned_until;
    public $banned_reason;
    public $selectedRoles = [];

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
    
        // Memastikan banned_until terformat dengan benar
        if ($user->banned_until) {
            $this->banned_until = \Carbon\Carbon::parse($user->banned_until)->toDateString(); // Konversi menjadi objek Carbon
        } else {
            $this->banned_until = null; // Jika tidak ada, set menjadi null
        }
        
        $this->banned_reason = $user->banned_reason;
    }
    
    public function assignRoles()
    {
        // Validasi untuk memastikan setidaknya satu role dipilih
        $this->validate([
            'selectedRoles' => 'required|array|min:1',
        ]);
    
        try {
            // Mengsinkronisasi roles dengan user
            $this->user->syncRoles($this->selectedRoles); // Ini akan menambah dan menghapus role secara otomatis
            // session()->flash('message', 'Roles updated successfully.');
            notify()->success('message', 'Roles updated successfully.');
        } catch (\Exception $ex) {
            // Menangani kesalahan
            notify()->success('error', 'Failed to update roles: ' . $ex->getMessage());
        }
    
        return redirect()->route('user'); // Redirect ke halaman user
    }
    

    /**
     * update the User data
     * @return void
     */
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        try {
            \App\Models\User::whereId($this->user->id)->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            // session()->flash('profile-updated', 'Profile User Update Successfully');
            notify()->success('profile-updated', 'Profile User Update Successfully');
            return redirect()->route('user');
        } catch (\Exception $ex) {
            notify()->success('error', 'Something goes wrong!!');
        }
    }

    public function banUser()
    {
        $this->validate([
            'banned_until' => 'required|date|after:today',
            'banned_reason' => 'required|string|max:255',
        ]);

        try {
            // Update the user’s banned status in the database
            \App\Models\User::whereId($this->user->id)->update([
                'banned_until' => $this->banned_until,
                'banned_reason' => $this->banned_reason,
            ]);

            // Flash a success message
            notify()->success('success', 'User banned successfully until ' . $this->banned_until . '.');
        } catch (\Exception $e) {
            // Flash an error message in case of an exception
            notify()->success('error', 'Failed to ban user: ' . $e->getMessage());
        }

        return redirect()->route('user'); // Redirect to the relevant page
    }

    public function unbanUser()
    {
        try {
            // Update status banned user menjadi null
            \App\Models\User::whereId($this->user->id)->update([
                'banned_until' => null,
                'banned_reason' => null, // Opsional: reset alasan banned
            ]);

            // Flash pesan sukses
            notify()->info('success', 'User unbanned successfully.');
        } catch (\Exception $e) {
            // Flash pesan error jika terjadi kesalahan
            notify()->success('error', 'Failed to unban user: ' . $e->getMessage());
        }

        return redirect()->route('user'); // Redirect ke halaman yang relevan
    }

    /**
     * Delete the user's account.
     */
    public function destroy($id)
    {
        try {
            $user = \App\Models\User::findOrFail($id);
            $user->delete();
    
            notify()->warning('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            notify()->warning('error', 'Failed to delete the user.');
        }
        return redirect()->route('user');
    }
    
    public function render()
    {
        return view('livewire.partials.view-user',['user' => $this->user]);
    }
}
