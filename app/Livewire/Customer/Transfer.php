<?php

namespace App\Livewire\Customer;

use App\Models\BankConfiguration;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

class Transfer extends Component
{
    public $lang;
    public BankConfiguration $data;
    public Order $order;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
        $id = session()->get("order_id") ?? request()->query("order_id");
        if (!$id) {
            Log::info("Transfer :: NO ORDER ID");
            return;
        }
        $this->data = BankConfiguration::first();
        $this->order = Order::find($id);
    }

    public function render(): View
    {
        return view('livewire.customer.transfer');
    }
}
