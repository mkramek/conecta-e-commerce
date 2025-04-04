<?php

namespace App\Livewire\Customer;

use App\Models\Address;
use App\Models\Cart;
use App\Models\ClientECommerce;
use App\Models\Courier;
use App\Models\DiscountCode;
use App\Models\IndividualPromotion;
use App\Models\InvoiceRegisterAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\PercentagePromotion;
use App\Services\OpenPayUService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Checkout extends Component
{
    use WireUiActions;

    public $lang;
    public $address_form = ['document' => 'no_invoice', 'nip' => '', 'company_name' => '', 'first_name' => '', 'last_name' => '', 'telephone_prefix' => '', 'telephone_number' => '', 'email' => '', 'street' => '', 'house_number' => '', 'apartment_number' => '', 'postal_code' => '', 'city' => '', 'province' => '', 'country' => '',];
    public $delivery_form = ['document' => 'no_invoice', 'duplicate' => true, 'nip' => '', 'company_name' => '', 'first_name' => '', 'last_name' => '', 'telephone_prefix' => '', 'telephone_number' => '', 'email' => '', 'street' => '', 'house_number' => '', 'apartment_number' => '', 'postal_code' => '', 'city' => '', 'province' => '', 'country' => '',];
    public $courier;
    public $payment_method;
    public Collection $couriers;
    public Collection $payment_methods;
    public Collection $items;
    public bool $gdpr;
    public bool $terms;
    public string $nameColumn;
    public float $total_amount = 0.0;
    public string $discount_code = '';
    public int $discount_code_id = -1;
    public float $delivery_fee;
    public bool $has_customizables = false;
    public bool $has_custom_offer = false;
    public float $subtracted_from_total = 0.0;
    public ?InvoiceRegisterAddress $invAddress = null;
    public ?InvoiceRegisterAddress $invDeliveryAddress = null;
    public Collection $individualPromos;
    public Collection $sitePromos;
    public $site_promo_id = null;
    public $individual_promo_id = null;

    public function rules()
    {
        return ['first_name' => 'required', 'last_name' => 'required', 'telephone_prefix' => 'required', 'telephone_number' => 'required',];
    }

    public function mount(): void
    {
        $this->couriers = Courier::select(['id', 'name', 'img_url', 'fee', 'enabled'])->where('enabled', true)->get();
        $this->lang = app()->getLocale();
        $this->nameColumn = "name_{$this->lang}";
        $this->items = Cart::where('customer_id', auth()->id() ?? session()->getId())->get();
        $this->total_amount = $this->getTotal();
        $this->has_customizables = Cart::where([
            'customer_id' => auth()->id() ?? session()->getId(),
            'is_customizable' => true,
        ])->count() > 0;
        $this->has_custom_offer = $this->items->filter(fn($it) => $it->custom_price_gross !== null)->count() > 0;
        if ($this->has_customizables) {
            $this->payment_methods = PaymentMethod::select(['id', 'type', 'name', 'img_url'])->where('type', 'custom')->get();
        } else {
            $this->payment_methods = PaymentMethod::select(['id', 'type', 'name', 'img_url'])->where('type', '<>', 'custom')->get();
        }

        if (auth()->check()) {
            $customer = ClientECommerce::find(auth()->id());
            $this->invAddress = $customer->invoiceRegisterAddresses->where('is_delivery', false)->first();
            $this->invDeliveryAddress = $customer->invoiceRegisterAddresses->where('is_delivery', true)->first();
            if ($this->invAddress !== null) {
                $this->address_form = [
                    'document' => 'invoice',
                    'first_name' => $customer->first_name,
                    'last_name' => $customer->last_name,
                    'email' => $customer->email,
                    'telephone_prefix' => $customer->telephone_prefix,
                    'telephone_number' => $customer->telephone_number,
                    ...$this->invAddress->getAttributes(),
                ];
            }
            if ($this->invDeliveryAddress !== null) {
                $this->delivery_form = [
                    'document' => 'invoice',
                    'duplicate' => false,
                    'first_name' => $customer->first_name,
                    'last_name' => $customer->last_name,
                    'email' => $customer->email,
                    'telephone_prefix' => $customer->telephone_prefix,
                    'telephone_number' => $customer->telephone_number,
                    ...$this->invDeliveryAddress->getAttributes(),
                ];
            }
            $this->individualPromos = IndividualPromotion::where('customer_id', auth()->id())->get();
        } else {
            $this->individualPromos = Collection::empty();
        }
        $this->sitePromos = PercentagePromotion::where('is_active', true)->whereTodayOrBefore('valid_from')->whereAfterToday('valid_until')->get();
    }

    public function getTotal($with_discounts = true): float
    {
        $total = array_reduce([...$this->items], function ($acc, $item) use ($with_discounts) {
            if ($with_discounts) {
                return $acc + $item->quantity * ($item->custom_price_gross ?? $item->variant->brutto_discount_price ?? $item->variant->brutto_price);
            }
            return $acc + $item->quantity * ($item->custom_price_gross ?? $item->variant->brutto_price);
        }, 0.0);

        if ($this->courier) {
            $this->delivery_fee = Courier::find($this->courier)->fee;
            $total += $this->delivery_fee;
        }
        if ($this->discount_code_id > 0) {
            $discount_code = DiscountCode::find($this->discount_code_id);
            $this->subtracted_from_total = $total * $discount_code->value / 100;
        } else if ($this->site_promo_id !== null) {
            $promo = PercentagePromotion::find($this->site_promo_id);
            $this->subtracted_from_total = $total * $promo->percentage_value / 100;
        } else if ($this->individual_promo_id !== null) {
            $promo = IndividualPromotion::find($this->individual_promo_id);
            if ($promo->products->count() > 0) {
                foreach ($this->items as $item) {
                    $discount_added = false;
                    if ($promo->products->contains(fn($it) => $it->id === $item->product_id)) {
                        if ($promo->is_percentage) {
                            $this->subtracted_from_total += $item->quantity * ($item->variant->brutto_price * ($promo->percentage / 100));
                        } else if (!$discount_added) {
                            $this->subtracted_from_total += $promo->discount_gross;
                            $discount_added = true;
                        }
                    }
                }
            } else {
                $this->subtracted_from_total = $promo->is_percentage ? $total * $promo->percentage / 100 : $promo->discount_gross;
            }
        } else {
            $this->subtracted_from_total = 0.0;
        }
        return max($total - $this->subtracted_from_total, 0);
    }

    public function render(): View
    {
        return view('livewire.customer.checkout');
    }

    public function applyPromoCode(): void
    {
        $code = DiscountCode::where(['code' => $this->discount_code, 'is_active' => true,])->first();
        if ($code && $code->exists()) {
            $this->individual_promo_id = null;
            $this->site_promo_id = null;
            $this->discount_code_id = $code->id;
            $this->notification()->success(title: __('Sukces'), description: __('Wprowadzono poprawny kod promocyjny!'));
        } else {
            $this->notification()->error(title: __('Błąd'), description: __('Wprowadzono nieprawidłowy kod promocyjny'));
        }
        $this->total_amount = $this->getTotal();
    }

    public function useIndividualPromo(?string $promoId = null): void
    {
        if ($promoId === null) {
            $this->individual_promo_id = null;
        } else {
            // reset the promotion's pricings
            $this->individual_promo_id = null;
            $this->total_amount = $this->getTotal();

            // recalculate promo prices
            $promo = IndividualPromotion::find($promoId);
            if ($promo) {
                $this->individual_promo_id = $promoId;
                $this->site_promo_id = null;
                $this->discount_code_id = -1;
            }
        }
        $this->total_amount = $this->getTotal();
    }

    public function useSitePromo(?string $promoId = null): void
    {
        if ($promoId === null) {
            $this->site_promo_id = null;
        } else {
            $promo = PercentagePromotion::find($promoId);
            if ($promo) {
                $this->individual_promo_id = null;
                $this->site_promo_id = $promoId;
                $this->discount_code_id = -1;
            }
        }
        $this->total_amount = $this->getTotal();
    }

    public function handleOrder(): RedirectResponse|Redirector
    {
        $customer = null;
        if (!auth()->check()) {
            if (!empty($this->address_form['nip']) && $this->address_form['nip'] !== '') {
                $invAddress = InvoiceRegisterAddress::where(['nip' => $this->address_form['nip'], 'is_delivery' => false])->first();
                if ($invAddress) {
                    $customer = $invAddress->clientECommerce;
                }
            } else {
                $customer = ClientECommerce::where([
                    'email' => $this->address_form['email'],
                ])->orWhere(fn($query) => $query->where([
                        'telephone_number' => $this->address_form['telephone_number'],
                        'telephone_prefix' => $this->address_form['telephone_prefix']
                    ]))->first();
            }
            if (!$customer) {
                $customer = ClientECommerce::create([
                    'email' => $this->address_form['email'],
                    'first_name' => $this->address_form['first_name'],
                    'last_name' => $this->address_form['last_name'],
                    'login' => uniqid('customer_', true),
                    'telephone_prefix' => $this->address_form['telephone_prefix'],
                    'telephone_number' => $this->address_form['telephone_number'],
                    'password' => password_hash(uniqid('', true), PASSWORD_BCRYPT),
                    'rodo_acceptance' => 1,
                ]);
            }
            $customer_id = $customer->id;
        } else {
            $customer_id = auth()->id();
            $customer = ClientECommerce::find(auth()->id());
        }
        $address = ['invoice' => false];
        $delivery = ['invoice' => false];
        if ($this->address_form['document'] === "invoice") {
            $address['invoice'] = true;
            $invoiceAddress = InvoiceRegisterAddress::where([
                'nip' => $this->address_form['nip'],
                'is_delivery' => false,
            ])->first();
            if (!$invoiceAddress) {
                $invoiceAddress = InvoiceRegisterAddress::create([
                    'client_e_commerce_id' => $customer_id,
                    'city' => $this->address_form['city'],
                    'country' => $this->address_form['country'],
                    'apartment_number' => $this->address_form['apartment_number'],
                    'house_number' => $this->address_form['house_number'],
                    'province' => $this->address_form['province'],
                    'street' => $this->address_form['street'],
                    'postal_code' => $this->address_form['postal_code'],
                    'nip' => $this->address_form['nip'],
                    'company_name' => $this->address_form['company_name'],
                ]);
            }
            $address['data'] = $invoiceAddress;
        } else {
            $nonInvoiceAddress = Address::where([
                'street' => $this->address_form['street'],
                'house_number' => $this->address_form['house_number'],
                'apartment_number' => $this->address_form['apartment_number'],
                'postal_code' => $this->address_form['postal_code'],
            ])->first();
            if (!$nonInvoiceAddress) {
                $nonInvoiceAddress = Address::create([
                    'client_e_commerce_id' => $customer_id,
                    'city' => $this->address_form['city'],
                    'country' => $this->address_form['country'],
                    'apartment_number' => $this->address_form['apartment_number'],
                    'house_number' => $this->address_form['house_number'],
                    'province' => $this->address_form['province'],
                    'street' => $this->address_form['street'],
                    'postal_code' => $this->address_form['postal_code'],
                ]);
            }
            $address['data'] = $nonInvoiceAddress;
        }
        if (!$this->delivery_form['duplicate']) {
            if ($this->delivery_form['document'] === "invoice") {
                $delivery['invoice'] = true;
                $delivery['data'] = InvoiceRegisterAddress::create([
                    'client_e_commerce_id' => $customer_id,
                    'city' => $this->delivery_form['city'],
                    'country' => $this->delivery_form['country'],
                    'apartment_number' => $this->delivery_form['apartment_number'],
                    'house_number' => $this->delivery_form['house_number'],
                    'province' => $this->delivery_form['province'],
                    'street' => $this->delivery_form['street'],
                    'postal_code' => $this->delivery_form['postal_code'],
                    'nip' => $this->delivery_form['nip'],
                    'company_name' => $this->delivery_form['company_name'],
                    'is_delivery' => true,
                ]);
            } else {
                $delivery['data'] = Address::create([
                    'client_e_commerce_id' => $customer_id,
                    'city' => $this->delivery_form['city'],
                    'country' => $this->delivery_form['country'],
                    'apartment_number' => $this->delivery_form['apartment_number'],
                    'house_number' => $this->delivery_form['house_number'],
                    'province' => $this->delivery_form['province'],
                    'street' => $this->delivery_form['street'],
                    'postal_code' => $this->delivery_form['postal_code'],
                    'is_delivery' => true,
                ]);
            }
        } else {
            $delivery['invoice'] = $address['invoice'];
            $delivery['data'] = $address['data'];
        }
        $order = Order::create([
            'id' => uniqid('cec_'),
            'user_id' => $customer_id,
            'total_amount' => $this->getTotal("brutto"),
            'payment_method_id' => $this->payment_method,
            'courier_id' => $this->courier,
            'address_id' => $address['invoice'] ? null : $address['data']->id,
            'invoice_address_id' => $address['invoice'] ? $address['data']->id : null,
            'delivery_address_id' => $delivery['invoice'] ? null : $delivery['data']->id,
            'invoice_delivery_address_id' => $delivery['invoice'] ? $delivery['data']->id : null,
            'discount_code_id' => $this->discount_code_id > 0 ? $this->discount_code_id : null,
        ]);

        foreach ($this->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item->variant->id,
                'quantity' => $item->quantity,
                'total_net' => $item->variant->netto_price * $item->quantity,
                'total_gross' => $item->variant->brutto_price * $item->quantity,
                'has_discount' => !!$item->variant->brutto_discount_price,
                'total_discount_net' => $item->variant->netto_discount_price * $item->quantity,
                'total_discount_gross' => $item->variant->brutto_discount_price * $item->quantity,
            ]);
        }

        // SymfoniaService::createOrder($customer, $order);

        Cart::where('customer_id', auth()->id() ?? session()->getId())->delete();

        $method = PaymentMethod::find($this->payment_method);
        if ($method->type === "gateway") {
            $openPayuService = new OpenPayUService($method);
            $payment_url = $openPayuService->createFrom($order);
            session()->put("order_id", $order->id);
            return redirect()->to($payment_url);
        } else {
            return redirect()->to(route("{$method->callback_url}.{$this->lang}", ['order_id' => $order->id]));
        }
    }

    public function updated($field): void
    {
        if (
            $field === "site_promo_id"
            || $field === "individual_promo_id"
            || $field === "discount_code_id"
        ) {
            $this->total_amount = $this->getTotal();
        }
        if ($field === "courier") {
            $crr = Courier::find($this->courier);
            if (!$crr->is_onsite) {
                $result = PaymentMethod::where('type', '<>', 'cash');
            } else {
                $result = PaymentMethod::query();
            }

            if ($this->has_customizables) {
                $result = $result->where('type', 'custom')->get();
            } else {
                $result = $result->where('type', '<>', 'custom')->get();
            }

            $this->payment_methods = $result;
        }
        $this->total_amount = $this->getTotal();
    }

    public function clearPromoCode()
    {
        $this->discount_code_id = -1;
    }
}
