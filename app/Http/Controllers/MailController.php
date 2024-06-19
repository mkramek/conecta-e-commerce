<?php

namespace App\Http\Controllers;

use App\Mail\Customer\CustomerCreated;
use App\Mail\Order\OrderCreated;
use App\Mail\Order\OrderPaid;
use App\Mail\Order\OrderShipped;
use App\Models\ClientECommerce;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    private const ORDER_ID = "cec_667244cbb09c8";

    public function sendCustomerCreated()
    {
        Mail::to("test@test.test")->send(new CustomerCreated(ClientECommerce::first()));
        return response()->json(['sent' => true], 201);
    }

    public function sendOrderCreated()
    {
        Mail::to("test@test.test")->send(new OrderCreated(Order::find(self::ORDER_ID)));
        return response()->json(['sent' => true], 201);
    }

    public function sendOrderPaid()
    {
        Mail::to("test@test.test")->send(new OrderPaid(Order::find(self::ORDER_ID)));
        return response()->json(['sent' => true], 201);
    }

    public function sendOrderShipped()
    {
        Mail::to("test@test.test")->send(new OrderShipped(Order::find(self::ORDER_ID)));
        return response()->json(['sent' => true], 201);
    }
}
