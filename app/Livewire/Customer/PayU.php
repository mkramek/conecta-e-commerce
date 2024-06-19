<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use App\Services\FedExService;
use App\Services\UPSService;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class PayU extends Component
{
    public $lang;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
        $id = session()->get("order_id") ?? request()->query("order_id");
        if (!$id) {
            Log::info("PayU :: NO ORDER ID");
            return;
        }
        $order = Order::find($id);
        $courier = $order->courier;
        if (strtolower($courier->name) === "ups") {
            $service = new UPSService($courier);
            $service->processShipment($order);
        } else if (strtolower($courier->name) === "fedex") {
            $service = new FedExService($courier);
            $service->processShipment($order);
        }
    }

    public function render(): View
    {
        return view('livewire.customer.pay-u');
    }
}
