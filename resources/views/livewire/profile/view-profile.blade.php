<div class="w-full px-4 my-8">
    <div class="flex max-w-screen-lg mx-auto justify-between items-center">
        <h1 class="text-4xl font-bold">{{ __('Profil') }}</h1>
        <div>
            @if (Auth::user()->is_b2b)
                <x-button href='{{ route("b2b.$lang") }}'
                          icon="arrow-left-end-on-rectangle"
                          label="{{ __('Panel B2B') }}" primary/>
            @endif
            <x-button icon="arrow-left-start-on-rectangle"
                      label="{{ __('Wyloguj się') }}" secondary
                      wire:click='handleLogout'/>
        </div>
    </div>
    <div class="flex flex-wrap mt-6 gap-4 justify-center lg:justify-evenly">
        <div class="basis-full lg:basis-[30%]">
            <h2 class="text-2xl">{{ __('Zamówienia') }}</h2>
            @if ($orders->isEmpty())
                <p class="text-lg mt-6 italic">{{ __('Brak zamówień') }}</p>
            @else
                <div class="mt-6 flex flex-col gap-4">
                    @foreach ($orders as $order)
                        <div class="border rounded p-2">
                            <p class="text-xs">{{ (new \Carbon\Carbon($order->created_at))->format('d.m.Y H:i') }}</p>
                            <p class="text-xl font-bold border-b">{{ $order->id }}</p>
                            <p>
                                <span>{{ __('Kwota') }}:</span>
                                <span class="font-bold">{{ number_format($order->total_amount, 2) }} PLN</span>
                            </p>
                            <p>
                                <span>{{ __('Status') }}:</span>
                                <span
                                    class="font-bold">{{ $this->status($order) }}</span>
                            </p>
                            <div class="mt-2">
                                @if ($order->payment_id)
                                    <x-button info
                                              href="{{ $order->payment_url }}">
                                        Link do płatności
                                    </x-button>
                                @elseif ($order->paymentMethod->type === 'transfer')
                                    <x-button info
                                              href='{{ route("order.payment.transfer.{$this->lang}", [`order_id` => $order->id]) }}'>
                                        Link do płatności
                                    </x-button>
                                @else
                                    <x-button info
                                              href='{{ route("order.payment.cash.{$this->lang}", [`order_id` => $order->id]) }}'>
                                        Link do płatności
                                    </x-button>
                                @endif
                                @if ($order->tracking_id)
                                    <x-button info
                                              href="{{ $order->tracking_url }}">
                                        Link do przesyłki
                                    </x-button>
                                @endif
                                <x-button green
                                          wire:click="toggle('{{ $order->id }}')">
                                    @if ($expanded === $order->id)
                                        <span>Ukryj szczegóły</span>
                                    @else
                                        <span>Pokaż szczegóły</span>
                                    @endif
                                </x-button>
                            </div>
                            @if ($expanded === $order->id)
                                <div class="mt-2">
                                    @if ($order->invoiceAddress)
                                        <h4 class="text-lg font-bold">Adres
                                            firmy</h4>
                                        <dl class="flex flex-wrap justify-between items-center">
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Nazwa firmy
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceAddress->company_name }}</dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                NIP
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">{{ $order->invoiceAddress->nip }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Miasto
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">{{ $order->invoiceAddress->city }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Ulica
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceAddress->street }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Nr domu
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceAddress->house_number }}</dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Nr mieszkania
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceAddress->apartment_number }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Kod pocztowy
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceAddress->postal_code }}</dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Kraj
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceAddress->country }}
                                            </dd>
                                        </dl>
                                    @endif
                                    @if ($order->deliveryAddress)
                                        <h4 class="text-lg font-bold mt-2">Adres
                                            dostawy</h4>
                                        <dl class="flex flex-wrap justify-between items-center">
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Miasto
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->deliveryAddress->city }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Ulica
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->deliveryAddress->street }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Nr domu
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->deliveryAddress->house_number }}</dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Nr mieszkania
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->deliveryAddress->apartment_number }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Kod pocztowy
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->deliveryAddress->postal_code }}</dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Kraj
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->deliveryAddress->country }}
                                            </dd>
                                        </dl>
                                    @elseif($order->invoiceDeliveryAddress)
                                        <h4 class="text-lg font-bold mt-2">Adres
                                            dostawy na fakturze</h4>
                                        <dl class="flex flex-wrap justify-between items-center">
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Nazwa firmy
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceDeliveryAddress->company_name }}</dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                NIP
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceDeliveryAddress->nip }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Miasto
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceDeliveryAddress->city }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Ulica
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceDeliveryAddress->street }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Nr domu
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceDeliveryAddress->house_number }}</dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Nr mieszkania
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceDeliveryAddress->apartment_number }}
                                            </dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Kod pocztowy
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceDeliveryAddress->postal_code }}</dd>
                                            <dt class="basis-1/2 text-sm text-gray-500">
                                                Kraj
                                            </dt>
                                            <dd class="basis-1/2 text-sm text-right">
                                                {{ $order->invoiceDeliveryAddress->country }}
                                            </dd>
                                        </dl>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="basis-full lg:basis-[30%]">
            <h2 class="text-2xl">{{ __('Ulubione') }}</h2>
            <div class="flex flex-col gap-4 mt-6">
                @if (count($favorites) === 0)
                    <p>Brak ulubionych produktów.</p>
                @endif
                @foreach ($favorites as $favorite)
                    @php
                        $variant = $favorite->variant;
                        $product = $variant->product;
                        $name_column = "name_$lang";
                        $slug_column = "slug_$lang";
                    @endphp
                    <div
                        class="flex gap-4 items-center justify-between p-2 border rounded">
                        <img
                            src='{{ $product->images->first()->url ?? 'https://via.placeholder.com/320x240' }}'
                            alt='{{ $product->$name_column }}'
                            class="max-h-24"/>
                        <p class="basis-1/3">{{ $product->$name_column }}</p>
                        @php
                            $product_route = route("product.$lang", [
                                'slug' => $product->$slug_column,
                                'id' => $product->id,
                                'variant' => $variant->id,
                            ]);
                        @endphp
                        <x-button class="basis-1/3"
                                  href='{{ $product_route }}'>{{ __('Przejdź do produktu') }}</x-button>
                        <x-button red wire:click="remove({{ $favorite->id }})">
                            <x-icon name="trash" class="w-5"/>
                        </x-button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="basis-full lg:basis-[30%]">
            <h2 class="text-2xl">{{ __('Adresy') }}</h2>
            <div class="flex gap-2 justify-between mt-6">
                @if ($address_tab === 'individual')
                    <x-button class="flex-1" disabled primary>
                        Osoba prywatna
                    </x-button>
                @else
                    <x-button
                        class="flex-1"
                        type="button"
                        primary
                        outline
                        wire:click="setAddressTab('individual')"
                    >
                        Osoba prywatna
                    </x-button>
                @endif
                @if($address_tab === 'company')
                    <x-button class="flex-1" disabled primary>
                        Firma
                    </x-button>
                @else
                    <x-button
                        class="flex-1"
                        type="button"
                        primary
                        outline
                        wire:click="setAddressTab('company')"
                    >Firma
                    </x-button>
                @endif
            </div>
            @if ($address_tab === 'individual')
                <div class="flex flex-col gap-4 mt-6">
                    <h4 class="text-xl font-semibold">Adres rozliczenia</h4>
                    <form wire:submit.prevent="setAddress"
                          class="flex flex-col gap-2">
                        <x-input label="Ulica" wire:model="addressForm.street"/>
                        <x-input label="Nr domu"
                                 wire:model="addressForm.house_number"/>
                        <x-input label="Nr mieszkania"
                                 wire:model="addressForm.apartment_number"/>
                        <x-input label="Kod pocztowy"
                                 wire:model="addressForm.postal_code"/>
                        <x-input label="Miasto" wire:model="addressForm.city"/>
                        <x-input label="Województwo"
                                 wire:model="addressForm.province"/>
                        <x-input label="Kraj" wire:model="addressForm.country"/>
                        <x-button type="submit" primary>Zaktualizuj</x-button>
                    </form>
                    <hr class="my-4"/>
                    <h4 class="text-xl font-semibold">Adres dostawy</h4>
                    <form wire:submit.prevent="setDelAddress"
                          class="flex flex-col gap-2">
                        <x-input label="Ulica"
                                 wire:model="delAddressForm.street"/>
                        <x-input label="Nr domu"
                                 wire:model="delAddressForm.house_number"/>
                        <x-input label="Nr mieszkania"
                                 wire:model="delAddressForm.apartment_number"/>
                        <x-input label="Kod pocztowy"
                                 wire:model="delAddressForm.postal_code"/>
                        <x-input label="Miasto"
                                 wire:model="delAddressForm.city"/>
                        <x-input label="Województwo"
                                 wire:model="delAddressForm.province"/>
                        <x-input label="Kraj"
                                 wire:model="delAddressForm.country"/>
                        <x-button type="submit" primary>Zaktualizuj</x-button>
                    </form>
                </div>
            @elseif ($address_tab === 'company')
                <div class="flex flex-col gap-4 mt-6">
                    <h4 class="text-xl font-semibold">Adres rozliczenia</h4>
                    <form wire:submit.prevent="setInvAddress"
                          class="flex flex-col gap-2">
                        <x-input label="Nazwa firmy"
                                 wire:model="invAddressForm.company_name"/>
                        <x-input label="NIP" wire:model="invAddressForm.nip"/>
                        <x-input label="Ulica"
                                 wire:model="invAddressForm.street"/>
                        <x-input label="Nr domu"
                                 wire:model="invAddressForm.house_number"/>
                        <x-input label="Nr mieszkania"
                                 wire:model="invAddressForm.apartment_number"/>
                        <x-input label="Kod pocztowy"
                                 wire:model="invAddressForm.postal_code"/>
                        <x-input label="Miasto"
                                 wire:model="invAddressForm.city"/>
                        <x-input label="Województwo"
                                 wire:model="invAddressForm.province"/>
                        <x-input label="Kraj"
                                 wire:model="invAddressForm.country"/>
                        <x-button type="submit" primary>Zaktualizuj</x-button>
                    </form>
                    <hr class="my-4"/>
                    <h4 class="text-xl font-semibold">Adres dostawy</h4>
                    <form wire:submit.prevent="setInvDelAddress"
                          class="flex flex-col gap-2">
                        <x-input label="Nazwa firmy"
                                 wire:model="invDelAddressForm.company_name"/>
                        <x-input label="NIP" wire:model="invAddressForm.nip"/>
                        <x-input label="Ulica"
                                 wire:model="invDelAddressForm.street"/>
                        <x-input label="Nr domu"
                                 wire:model="invDelAddressForm.house_number"/>
                        <x-input label="Nr mieszkania"
                                 wire:model="invDelAddressForm.apartment_number"/>
                        <x-input label="Kod pocztowy"
                                 wire:model="invDelAddressForm.postal_code"/>
                        <x-input label="Miasto"
                                 wire:model="invDelAddressForm.city"/>
                        <x-input label="Województwo"
                                 wire:model="invDelAddressForm.province"/>
                        <x-input label="Kraj"
                                 wire:model="invDelAddressForm.country"/>
                        <x-button type="submit" primary>Zaktualizuj</x-button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <x-modal wire:model.defer="addressUpdateModal">
        <x-card title="Potwierdzenie">
            <p class="text-gray-600">
                Dane zostały pomyślnie zaktualizowane.
            </p>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button primary label="OK" wire:click="closeModal"/>
                </div>
            </x-slot>
        </x-card>
    </x-modal>
    <x-modal wire:model.defer="addressErrorModal">
        <x-card title="Błąd">
            <p class="text-gray-600">
                Wystąpił błąd podczas aktualizacji adresu. Spróbuj ponownie.
            </p>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button primary label="OK" wire:click="closeModal"/>
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
