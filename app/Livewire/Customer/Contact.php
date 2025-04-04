<?php

namespace App\Livewire\Customer;

use Illuminate\Mail\Mailable;
use Livewire\Component;
use WireUi\Traits\WireUiActions;
use \App\Models\Footer as FooterModel;

class Contact extends Component
{
    use WireUiActions;

    public FooterModel $contact;

    public $contactForm = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'message' => '',
    ];

    public function rules()
    {
        return [
            'contactForm.name' => 'string',
            'contactForm.email' => 'string|email',
            'contactForm.phone' => 'string',
            'contactForm.message' => 'string',
        ];
    }

    public function mount()
    {
        $this->contact = FooterModel::first();
    }

    public function render()
    {
        return view('livewire.customer.contact');
    }

    public function handleSubmit()
    {
        $mail = new Mailable();
        $mail->to($this->contactForm['email'])->subject("Dziękujemy za wysłanie zapytania!")->text("Dziękujemy za wysłanie zapytania! Odpowiemy na nie najszybciej, jak to tylko możliwe.\n\nPozdrawiamy,\nZespół Conecta");
    }
}
