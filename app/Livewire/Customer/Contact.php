<?php

namespace App\Livewire\Customer;

use App\Notifications\QuestionClientNotification;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Contact extends Component
{
    use WireUiActions;

    public $contact = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'message' => '',
    ];

    public function mount()
    {
        $this->contact = \App\Models\Footer::first();
    }

    public function render()
    {
        return view('livewire.customer.contact');
    }

    public function handleSubmit()
    {
        $mail = new Mailable();
        $mail->to($this->contact['email'])->subject("Dziękujemy za wysłanie zapytania!")->text();
    }
}
