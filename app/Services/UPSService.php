<?php

namespace App\Services;

use App\Models\Address;
use App\Models\CompanyConfig;
use App\Models\Courier;
use App\Models\InvoiceRegisterAddress;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UPSService
{
    private Courier $data;
    private CompanyConfig $company;

    public function __construct(Courier $courier)
    {
        $this->company = CompanyConfig::first();
        $this->data = $courier;
    }

    public function processShipment(Order $order): void
    {
        if ($order->tracking_id && $order->tracking_url)
            return;
        $token = $this->authorize();
        Log::info("ORDER_SHIPMENT :: $order");
        $customer = $order->customer;
        $is_invoice = $order->invoice_delivery_address_id !== null;
        /** @var InvoiceRegisterAddress|Address $address */
        $address = $is_invoice
            ? InvoiceRegisterAddress::find($order->invoice_delivery_address_id)
            : Address::find($order->delivery_address_id);
        $customerAddressLine = $address->apartment_number ? "{$address->street} {$address->house_number}/{$address->apartment_number}" : "{$address->street} {$address->house_number}";
        $request = [
            "ShipmentRequest" => [
                "Request" => [
                    "RequestOption" => "nonvalidate",
                ],
                "Shipment" => [
                    "Description" => __('Zamówienie #:id', ['id' => $order->id]),
                    "Shipper" => [
                        "Name" => $this->company->name,
                        "TaxIdentificationNumber" => $this->company->vat_id,
                        "Phone" => [
                            "Number" => $this->company->telephone_number,
                            "Extension" => $this->company->telephone_prefix,
                        ],
                        "ShipperNumber" => $this->data->user_id,
                        "Address" => [
                            "AddressLine" => [$this->company->address_line_1, $this->company->address_line_2],
                            "City" => $this->company->city,
                            "PostalCode" => $this->company->postal_code,
                            "CountryCode" => "PL"
                        ]
                    ],
                    "ShipTo" => [
                        "Name" => $is_invoice ? $address->company_name : "{$customer->first_name} {$customer->last_name}",
                        "Phone" => [
                            "Number" => $customer->telephone_number,
                            "Extension" => $customer->telephone_prefix
                        ],
                        "Address" => [
                            "AddressLine" => [$customerAddressLine],
                            "City" => $address->city,
                            "PostalCode" => $address->postal_code,
                            "CountryCode" => "PL",
                        ],
                    ],
                    "Service" => [
                        "Code" => "11",
                        "Description" => "Standard"
                    ],
                    "Package" => [
                        [
                            "Description" => " ",
                            "Packaging" => [
                                "Code" => "02",
                            ],
                            "PackageWeight" => [
                                "UnitOfMeasurement" => [
                                    "Code" => "KGS",
                                    "Description" => "Kilograms",
                                ],
                                "Weight" => "5",
                            ],
                        ]
                    ],
                    "PaymentInformation" => [
                        "ShipmentCharge" => [
                            "Type" => "01",
                            "BillShipper" => [
                                "AccountNumber" => $this->data->user_id,
                            ]
                        ]
                    ]
                ],
                "LabelSpecification" => [
                    "LabelImageFormat" => [
                        "Code" => "GIF",
                    ],
                ]
            ]
        ];
        $shipment = Http::asJson()
            ->withHeader("Authorization", $token)
            ->post("{$this->data->api_url}/api/shipments/v2403/ship", $request);
        Log::info("SHIPPING_CREATED");
        $response = $shipment->json();
        $tracking_id = $response["ShipmentResponse"]["ShipmentResults"]["PackageResults"][0]["TrackingNumber"];
        $shipment_label_raw = $response["ShipmentResponse"]["ShipmentResults"]["PackageResults"][0]["ShippingLabel"]["GraphicImage"];
        $tracking_query = [
            "loc" => app()->getLocale() === "pl" ? "pl_PL" : "en_US",
            "tracknum" => $tracking_id,
            "requester" => "WT/trackdetails"
        ];
        $order->update([
            'tracking_id' => $tracking_id,
            'tracking_url' => "https://www.ups.com/track?" . http_build_query($tracking_query),
            'shipment_label_raw' => $shipment_label_raw,
        ]);
    }

    private function authorize()
    {
        $response = Http::withBasicAuth(
            username: $this->data->client_id,
            password: $this->data->client_secret,
        )
            ->withHeader("x-merchant-id", $this->data->user_id)
            ->asForm()
            ->post("{$this->data->api_url}/security/v1/oauth/token", [
                'grant_type' => 'client_credentials'
            ]);
        $token_type = $response->json('token_type');
        $access_token = $response->json('access_token');
        return "$token_type $access_token";
    }
}
