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
        $apiUrl = config('app.symfonia.api_url');

        $token = self::openSession();

        try {
            $customerCode = uniqid();
            $companyAddress = $customer->invoiceRegisterAddress;
            $deliveryAddress = $customer->address;
            $symfoniaCustomer = Http::withHeader('Authorization', "Session $token")->post("$apiUrl/Contractors/Create?syncFk=false", [
                'Active' => true,
                "Code" => $customerCode,
                "Name" => $companyAddress ? $companyAddress->company_name : "{$customer->first_name} {$customer->last_name}",
                "Vies" => !!$companyAddress,
                "VATTaxPayer" => !!$companyAddress,
                "NIP" => $companyAddress ? $companyAddress->nip : '',
                "PriceNegotiation" => false,
                "Type" => 1,
                "Note" => "",
                "Contact" => [
                    "Name" => $customer->first_name,
                    "Surname" => $customer->last_name,
                    "Phone1" => "{$customer->telephone_prefix}{$customer->telephone_number}",
                    "Phone2" => "",
                    "Fax" => "",
                    "Email" => $customer->email,
                    "WWW" => "",
                    "Facebook" => "",
                ],
                "DefaultAddress" => [
                    "Country" => "PL",
                    "City" => $companyAddress ? $companyAddress->city : $deliveryAddress->city,
                    "Province" => $companyAddress ? $companyAddress->province : $deliveryAddress->province,
                    "Street" => $companyAddress ? $companyAddress->street : $deliveryAddress->street,
                    "HouseNo" => $companyAddress ? $companyAddress->house_number : $deliveryAddress->house_number,
                    "ApartmentNo" => $companyAddress ? $companyAddress->apartment_number : $deliveryAddress->apartment_number,
                    "PostCode" => $companyAddress ? $companyAddress->postal_code : $deliveryAddress->postal_code,
                ],
            ]);
            if ($symfoniaCustomer->ok()) {
                $customer->update(['symfonia_code' => $customerCode]);
            }
            $orderRequest = Http::withHeader("Authorization", "Session $token")->post("$apiUrl/OrdersIssue/New?issue=true", [
                "TypeCode" => "ZMO",
                "Series" => "sZMO",
                "Department" => "CONECTA",
                "Warehouse" => "CONECTA",
                "PaymentRegistry" => [
                    "Code" => "BANK SKLEP WWW"
                ],
                "PaymentFormId" => 67362,
                "SalePriceType" => "4",
                "Note" => "",
                "Description" => "Zamówienie ze sklepu WWW, nr zam. {$order->id}",
                "ReceivedBy" => "",
                "PriceKind" => 1,
                "Marker" => "79",
                "ReservationType" => 0,
                "Positions" => array_map(fn(OrderItem $item) => [
                    'Code' => $item->variant->symfonia_id,
                    'Quantity' => $item->quantity,
                    'Value' => $item->has_discount ? $item->total_discount_gross : $item->total_gross,
                ], $order->items),
                "Buyer" => [
                    "Code" => $customerCode
                ],
                "Recipient" => [
                    "Code" => $customerCode
                ]
            ]);

            return $orderRequest->ok();
        } catch (Exception $e) {
            Log::error("SYMFONIA ORDER ERROR :: {$e->getMessage()}");
            return false;
        } finally {
            self::closeSession($token);
        }
    }

    private static function openSession(): string
    {
        $apiKey = config('app.symfonia.api_key');
        $apiUrl = config('app.symfonia.api_url');

        $auth = Http::withHeader('Authorization', "Application $apiKey")->get("$apiUrl/Sessions/OpenNewSession?deviceName=ecommerce");
        return stripslashes($auth->body());
    }

    private static function closeSession($token): void
    {
        $apiUrl = config('app.symfonia.api_url');

        Http::withHeader("Authorization", "Session $token")->get("$apiUrl/Sessions/CloseSession");
    }
}
