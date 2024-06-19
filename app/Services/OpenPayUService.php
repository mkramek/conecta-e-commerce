<?php

namespace App\Services;

use App\Models\ClientECommerce;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use OauthCacheFile;
use OpenPayU_Configuration;
use OpenPayU_Exception;
use OpenPayU_Exception_Configuration;
use OpenPayU_Order;

class OpenPayUService
{
    public PaymentMethod $method;

    public function __construct(PaymentMethod $method)
    {
        $this->method = $method;
        try {
            OpenPayU_Configuration::setEnvironment('sandbox');
            //set POS ID and Second MD5 Key (from merchant admin panel)
            OpenPayU_Configuration::setMerchantPosId($method->merchant_id);
            OpenPayU_Configuration::setSignatureKey($method->signature);

            //set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
            OpenPayU_Configuration::setOauthClientId($method->client_id);
            OpenPayU_Configuration::setOauthClientSecret($method->client_secret);

            OpenPayU_Configuration::setOauthTokenCache(new OauthCacheFile(storage_path('cache')));
        } catch (OpenPayU_Exception_Configuration $e) {
            Log::error($e);
        }
    }

    public function createFrom(Order $order): string
    {
        Log::info("NEW ORDER :: {$order->id}");
        $lang = app()->getLocale();
        $customer = ClientECommerce::find($order->user_id);
        $payuOrder = [];
        $payuOrder['continueUrl'] = route("{$this->method->callback_url}.$lang", ['order_id' => $order->id]);
        $payuOrder['notifyUrl'] = route("{$this->method->status_url}.$lang");
        $payuOrder['customerIp'] = $_SERVER['REMOTE_ADDR'];
        $payuOrder['merchantPosId'] = OpenPayU_Configuration::getOauthClientId() ? OpenPayU_Configuration::getOauthClientId() : OpenPayU_Configuration::getMerchantPosId();
        $payuOrder['description'] = __('Zamówienie #:id', ['id' => $order->id]);
        $payuOrder['currencyCode'] = 'PLN';
        $payuOrder['totalAmount'] = $order->total_amount * 100;
        $payuOrder['extOrderId'] = $order->id;

        foreach ($order->items as $item) {
            $name = "name_" . app()->getLocale();
            $variant = ProductVariant::find($item->product_variant_id);
            $payuOrder['products'][] = [
                'name' => $variant->$name,
                'unitPrice' => $item->total_gross * 100,
                'quantity' => $item->quantity,
            ];
        }

        $payuOrder['buyer']['email'] = $customer->email;
        $payuOrder['buyer']['phone'] = "+" . $customer->telephone_prefix . $customer->telephone_number;
        $payuOrder['buyer']['firstName'] = $customer->first_name;
        $payuOrder['buyer']['lastName'] = $customer->last_name;
        $payuOrder['buyer']['language'] = app()->getLocale();

        try {
            $req = OpenPayU_Order::create($payuOrder);
            $response = $req->getResponse();
            $order->update([
                'payment_id' => $response->orderId,
                'payment_url' => $response->redirectUri
            ]);
            return $response->redirectUri;
        } catch (OpenPayU_Exception $e) {
            Log::error($e);
            return "";
        }
    }
}
