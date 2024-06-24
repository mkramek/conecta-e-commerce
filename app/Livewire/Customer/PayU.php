<?php

namespace App\Livewire\Customer;

use Illuminate\View\View;
use Livewire\Component;

class PayU extends Component
{
    public $lang;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
    }

    public function render(): View
    {
        return view('livewire.customer.pay-u');
    }
}
