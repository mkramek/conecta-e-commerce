<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class Contact extends Component
{
    public $contact;

    public function mount()
    {
        $this->contact = \App\Models\Footer::first();
    }

    public function render()
    {
        return view('livewire.customer.contact');
    }
}
