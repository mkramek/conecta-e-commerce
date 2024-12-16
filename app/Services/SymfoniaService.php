<?php

namespace App\Services;

use App\Models\ClientECommerce;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SymfoniaService
{
    public static function createOrder(ClientECommerce $customer, Order $order): bool
    {
        return true;
    }

    private static function openSession(): string
    {
        $apiKey = config('app.symfonia.api_key');
        $apiUrl = config('app.symfonia.api_url');

        $auth = Http::withoutVerifying()->withHeader('Authorization', "Application $apiKey")->get("$apiUrl/Sessions/OpenNewSession?deviceName=ecommerce");
        return stripslashes($auth->body());
    }

    private static function closeSession($token): void
    {
        $apiUrl = config('app.symfonia.api_url');

        Http::withoutVerifying()->withHeader("Authorization", "Session $token")->get("$apiUrl/Sessions/CloseSession");
    }
}
