<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Cash extends Component
{
    public $lang;
    public Order $order;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
        $id = session()->get("order_id") ?? request()->query("order_id");
        if (!$id) {
            Log::info("Transfer :: NO ORDER ID");
            return;
        }
        $this->order = Order::find($id);
    }

    public function render()
    {
        return view('livewire.customer.cash');
    }
}
