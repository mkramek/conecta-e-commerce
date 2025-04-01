<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class PayU extends Component
{
    public $lang;

    #[Url]
    public $order_id;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
    }

    public function render(): View
    {
        return view('livewire.customer.pay-u');
    }
}
