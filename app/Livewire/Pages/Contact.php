<?php

namespace App\Livewire\Pages;

use App\Models\Report;
use Livewire\Component;

class Contact extends Component
{   
    public $category;
    public $message;

    protected $rules = [
        'category' => 'required',
        'message' => 'required|string',
    ];

    public function submit()
    {   
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect jika user belum login
        }

        $this->validate();
        try {
            Report::create([ 
                'user_id' => auth()->user()->id, // Ambil ID pengguna yang sedang login
                'category' => $this->category,
                'message' => $this->message,
            ]);

             // Mengatur session dengan tipe dan pesan
            notify()->success('Message has ben send!');
            return redirect()->route("contact");
        } catch (\Exception $ex) {
            notify()->warning('message', 'Something went wrong: ' . $ex->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.contact');
    }
}
