<?php

namespace App\Livewire\Pages;

use App\Models\Report;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;

class Contact extends Component
{   
    use UsesSpamProtection;
    use WithFileUploads;

    public $category;
    public $message;
    public $image;

    public HoneypotData $extraFields;

    protected $rules = [
        'category' => 'required',
        'message' => 'required|string',
        'image' => 'max:4093|mimes:avif,jpg,png,jpeg,gif',
    ];

    public function mount()
    {
        $this->extraFields = new HoneypotData();
    }

    public function submit()
    {   
        $this->protectAgainstSpam();
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect jika user belum login
        }

        $this->validate();
        try {
            Report::create([ 
                'user_id' => auth()->user()->id, // Ambil ID pengguna yang sedang login
                'category' => $this->category,
                'image' => $this->image->store('images', 'public'),
                'message' => $this->message,
            ]);
            
             // Mengatur session dengan tipe dan pesan
            notify()->success('Message has ben send!');
            return redirect()->route("contact");
        } catch (\Exception $ex) {
            notify()->warning('message', 'Something went wrong: ' . $ex->getMessage());
        }
    }

    public function removeImage()
    {
        $this->image = null;
    }

    public function render()
    {
        return view('livewire.pages.contact');
    }
}
