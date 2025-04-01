<?php

namespace App\Livewire\Profile;

use App\Models\Address;
use App\Models\ClientECommerce;
use App\Models\DeliveryAddress;
use App\Models\Favorite;
use App\Models\InvoiceRegisterAddress;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class ViewProfile extends Component
{
    use WireUiActions;

    public ?string $expanded = null;

    public string $lang;

    public Collection $orders;

    public Collection $favorites;

    public ClientECommerce $customer;

    public ?InvoiceRegisterAddress $invAddress;

    public ?InvoiceRegisterAddress $invDelAddress;

    public ?DeliveryAddress $delAddress;

    public ?Address $address;

    public ?string $address_tab = null;

    public array $addressForm = [
        'city' => '',
        'street' => '',
        'house_number' => '',
        'apartment_number' => '',
        'postal_code' => '',
        'province' => '',
        'country' => '',
    ];

    public array $delAddressForm = [
        'city' => '',
        'street' => '',
        'house_number' => '',
        'apartment_number' => '',
        'postal_code' => '',
        'province' => '',
        'country' => '',
    ];

    public array $invAddressForm = [
        'company_name' => '',
        'nip' => '',
        'city' => '',
        'street' => '',
        'house_number' => '',
        'apartment_number' => '',
        'postal_code' => '',
        'province' => '',
        'country' => '',
    ];

    public array $invDelAddressForm = [
        'company_name' => '',
        'nip' => '',
        'city' => '',
        'street' => '',
        'house_number' => '',
        'apartment_number' => '',
        'postal_code' => '',
        'province' => '',
        'country' => '',
    ];

    public bool $is_business = false;

    public bool $addressUpdateModal = false;

    public bool $addressErrorModal = false;

    public function toggle($orderId)
    {
        if ($this->expanded === $orderId) {
            $this->expanded = null;
        } else {
            $this->expanded = $orderId;
        }
    }

    public function mount(): void
    {
        $this->customer = ClientECommerce::find(auth()->id());
        $this->invAddress = $this->customer->invoiceRegisterAddress();
        $this->invDelAddress = $this->customer->invoiceRegisterAddresses->where('is_delivery', true)->first();
        $this->delAddress = $this->customer->deliveryAddresses()->first();
        $this->address = $this->customer->address;
        if ($this->invAddress) {
            $this->invAddressForm = [
                ...$this->invAddress->getAttributes(),
            ];
        }
        if ($this->invDelAddress) {
            $this->invDelAddressForm = [
                ...$this->invDelAddress->getAttributes(),
            ];
        }
        if ($this->delAddress) {
            $this->delAddressForm = [
                ...$this->delAddress->getAttributes(),
            ];
        }
        if ($this->address) {
            $this->addressForm = [
                ...$this->address->getAttributes(),
            ];
        }
        $customer = ClientECommerce::find(auth()->id());
        $this->is_business = (bool) $customer->is_b2b;
        $this->lang = app()->getLocale();
        $this->orders = Order::where('user_id', auth()->id())->get();
        $this->favorites = Favorite::where('customer_id', auth()->id())->has('variant')->get();
    }

    public function render(): View
    {
        return view('livewire.profile.view-profile');
    }

    public function remove($id): void
    {
        Favorite::find($id)->delete();
        $this->notification()->success(
            title: __('Usunięto'),
            description: __('Pomyślnie usunięto przedmiot z ulubionych')
        );
    }

    public function status(Order $order)
    {
        switch ($order->status) {
            case 'pending':
                return __('Oczekujące');
            case 'processing':
                return __('Przetwarzane');
            case 'shipped':
                return __('Wysłane');
            case 'delivered':
                return __('Dostarczone');
        }
    }

    public function setAddress()
    {
        try {
            if (! $this->customer->address) {
                $address = new Address([...$this->addressForm, 'client_e_commerce_id' => auth()->id()]);
                $address->save();
            } else {
                $this->customer->address->update($this->addressForm);
            }
            $this->addressUpdateModal = true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addressErrorModal = true;
        }
    }

    public function setDelAddress()
    {
        try {
            if (! $this->customer->deliveryAddresses()->first()) {
                $delAddress = new DeliveryAddress([...$this->delAddressForm, 'client_e_commerce_id' => auth()->id()]);
                $delAddress->save();
            } else {
                $this->customer->deliveryAddresses()->first()->update($this->delAddressForm);
            }
            $this->addressUpdateModal = true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addressErrorModal = true;
        }
    }

    public function setInvAddress()
    {
        try {
            if (! $this->customer->invoiceRegisterAddress()) {
                $invAddress = new InvoiceRegisterAddress([...$this->invAddressForm, 'client_e_commerce_id' => auth()->id(), 'is_delivery' => false]);
                $invAddress->save();
            } else {
                $this->customer->invoiceRegisterAddress()->update($this->invAddressForm);
            }
            $this->addressUpdateModal = true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addressErrorModal = true;
        }
    }

    public function setInvDelAddress()
    {
        try {
            if (! $this->customer->invoiceRegisterAddresses->where('is_delivery', true)->first()) {
                InvoiceRegisterAddress::create([
                    ...$this->invAddressForm,
                    'client_e_commerce_id' => auth()->id(),
                    'is_delivery' => true,
                ]);
            } else {
                $this->customer->invoiceRegisterAddresses->where('is_delivery', true)->first()->update($this->invDelAddressForm);
            }
            $this->addressUpdateModal = true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addressErrorModal = true;
        }
    }

    public function closeModal()
    {
        $this->addressErrorModal = false;
        $this->addressUpdateModal = false;
    }

    public function handleLogout()
    {
        auth()->logout();
        return redirect()->route("home.{$this->lang}");
    }

    public function setAddressTab(string $tab)
    {
        $this->address_tab = $tab;
    }
}
