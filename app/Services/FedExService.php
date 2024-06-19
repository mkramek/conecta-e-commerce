<?php

namespace App\Services;

use App\Models\Address;
use App\Models\CompanyConfig;
use App\Models\Courier;
use App\Models\InvoiceRegisterAddress;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FedExService
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
        $availability = Http::withHeader("Authorization", $token)->asJson()->post("https://apis.fedex.com/availability/v1/packageandserviceoptions", [
            "requestedShipment" => [
                "shipper" => [
                    "address" => [
                        "postalCode" => str_replace("-", "", $this->company->postal_code),
                        "countryCode" => "PL"
                    ]
                ],
                "recipients" => [
                    [
                        "address" => [
                            "postalCode" => str_replace("-", "", $address->postal_code),
                            "countryCode" => "PL"
                        ]
                    ]
                ]
            ],
            "carrierCodes" => [
                "FDXE",
                "FDXG"
            ]
        ]);
        Log::info("AVAILABILITY :: " . $availability->body());
        $customerAddressLine = $address->apartment_number ? "{$address->street} {$address->house_number}/{$address->apartment_number}" : "{$address->street} {$address->house_number}";
        $request = [
            "mergeLabelDocOptions" => "LABELS_ONLY",
            "requestedShipment" => [
                "shipDatestamp" => Carbon::now()->format("Y-m-d"),
                "totalDeclaredValue" => [
                    "amount" => $order->total_amount,
                    "currency" => "PLN",
                ],
                "shipper" => [
                    "address" => [
                        "streetLines" => [$this->company->address_line_1, $this->company->address_line_2],
                        "city" => $this->company->city,
                        "postalCode" => str_replace("-", "", $this->company->postal_code),
                        "countryCode" => "PL"
                    ],
                    "contact" => [
                        "companyName" => $this->company->name,
                        "phoneExtension" => $this->company->telephone_prefix,
                        "phoneNumber" => $this->company->telephone_number,
                        "emailAddress" => $this->company->email,
                    ],
                    "tins" => [
                        [
                            "number" => $this->company->vat_id,
                            "tinType" => "BUSINESS_NATIONAL"
                        ]
                    ],
                ],
                "recipients" => [
                    [
                        "address" => [
                            "streetLines" => [$customerAddressLine],
                            "city" => $address->city,
                            "postalCode" => str_replace("-", "", $address->postal_code),
                            "countryCode" => "PL",
                        ],
                        "contact" => [
                            "personName" => "{$customer->first_name} {$customer->last_name}",
                            "phoneNumber" => $customer->telephone_number,
                            "phoneExtension" => $customer->telephone_prefix,
                            "companyName" => $is_invoice ? $address->company_name : "",
                        ],
                        "tins" => $is_invoice ? [
                            [
                                "number" => $address->nip,
                                "tinType" => "BUSINESS_NATIONAL"
                            ]
                        ] : [],
                    ],
                ],
                "pickupType" => "CONTACT_FEDEX_TO_SCHEDULE",
                "serviceType" => "FEDEX_EXPRESS_SAVER",
                "packagingType" => "YOUR_PACKAGING",
                "shippingChargesPayment" => [
                    "paymentType" => "SENDER"
                ],
                "labelSpecification" => [
                    "labelFormatType" => "COMMON2D",
                    "labelOrder" => "SHIPPING_LABEL_FIRST",
                    "labelStockType" => "PAPER_4X6",
                    "imageType" => "PDF",
                ],
                "requestedPackageLineItems" => [
                    [
                        "weight" => [
                            "units" => "KG",
                            "value" => 5.0
                        ]
                    ]
                ],
            ],
            "labelResponseOptions" => "LABEL",
            "accountNumber" => [
                "value" => $this->data->user_id,
            ]
        ];
        $shipment = Http::asJson()
            ->withHeader("Authorization", $token)
            ->post("{$this->data->api_url}/ship/v1/shipments", $request);
        Log::info("SHIPPING_CREATED");
        Log::info($shipment->body());
//        $response = $shipment->json();
//        $tracking_id = $response["ShipmentResponse"]["ShipmentResults"]["PackageResults"][0]["TrackingNumber"];
//        $shipment_label_raw = $response["ShipmentResponse"]["ShipmentResults"]["PackageResults"][0]["ShippingLabel"]["GraphicImage"];
//        $tracking_query = [
//            "loc" => app()->getLocale() === "pl" ? "pl_PL" : "en_US",
//            "tracknum" => $tracking_id,
//            "requester" => "WT/trackdetails"
//        ];
//        $order->update([
//            'tracking_id' => $tracking_id,
//            'tracking_url' => "https://www.ups.com/track?" . http_build_query($tracking_query),
//            'shipment_label_raw' => $shipment_label_raw,
//        ]);
    }

    private function authorize(): string
    {
        $response = Http::asForm()
            ->post("{$this->data->api_url}/oauth/token", [
                'grant_type' => 'client_credentials',
                'client_id' => $this->data->client_id,
                'client_secret' => $this->data->client_secret,
            ]);
        $token_type = $response->json('token_type');
        $access_token = $response->json('access_token');
        return "$token_type $access_token";
    }
}
