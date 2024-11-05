<div class="max-w-screen-xl mx-auto my-8">
    <div class="flex w-full justify-between items-center">
        <h1 class="text-4xl font-bold">{{ __('Profil') }}</h1>
        <div>
            @if (Auth::user()->is_b2b)
                <x-button href='{{ route("b2b.$lang") }}' icon="logout" label="{{ __('Panel B2B') }}" primary />
            @endif
            <x-button icon="logout" label="{{ __('Wyloguj się') }}" secondary />
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
                                <span class="font-bold">{{ $this->status($order) }}</span>
                            </p>
                            <div class="mt-2">
                                @if ($order->payment_id)
                                    <x-button info href="{{ $order->payment_url }}">
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
                                    <x-button info href="{{ $order->tracking_url }}">
                                        Link do przesyłki
                                    </x-button>
                                @endif
                            </div>
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
                    <div class="flex gap-4 items-center justify-between p-2 border rounded">
                        <img src='{{ $product->images->first()->url ?? 'https://via.placeholder.com/320x240' }}'
                            alt='{{ $product->$name_column }}' class="max-h-24" />
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
                            <x-icon name="trash" class="w-5" />
                        </x-button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="basis-full lg:basis-[30%]">
            <h2 class="text-2xl">{{ __('Adresy') }}</h2>
            <div class="flex flex-col gap-4 mt-6">
                <h4 class="text-xl font-semibold">Adres rozliczenia</h4>
                <form wire:submit.prevent="setAddress" class="flex flex-col gap-2">
                    <x-input label="Ulica" wire:model="addressForm.street" />
                    <x-input label="Nr domu" wire:model="addressForm.house_number" />
                    <x-input label="Nr mieszkania" wire:model="addressForm.apartment_number" />
                    <x-input label="Kod pocztowy" wire:model="addressForm.postal_code" />
                    <x-input label="Miasto" wire:model="addressForm.city" />
                    <x-input label="Województwo" wire:model="addressForm.province" />
                    <x-input label="Kraj" wire:model="addressForm.country" />
                    <x-button type="submit" primary>Zaktualizuj</x-button>
                </form>
                <hr class="my-4" />
                <h4 class="text-xl font-semibold">Adres dostawy</h4>
                <form wire:submit.prevent="setDelAddress" class="flex flex-col gap-2">
                    <x-input label="Ulica" wire:model="delAddressForm.street" />
                    <x-input label="Nr domu" wire:model="delAddressForm.house_number" />
                    <x-input label="Nr mieszkania" wire:model="delAddressForm.apartment_number" />
                    <x-input label="Kod pocztowy" wire:model="delAddressForm.postal_code" />
                    <x-input label="Miasto" wire:model="delAddressForm.city" />
                    <x-input label="Województwo" wire:model="delAddressForm.province" />
                    <x-input label="Kraj" wire:model="delAddressForm.country" />
                    <x-button type="submit" primary>Zaktualizuj</x-button>
                </form>
                <hr class="my-4" />
                <h4 class="text-xl font-semibold">Adres na fakturze</h4>
                <form wire:submit.prevent="setInvAddress" class="flex flex-col gap-2">
                    <x-input label="Nazwa firmy" wire:model="invAddressForm.company_name" />
                    <x-input label="NIP" wire:model="invAddressForm.nip" />
                    <x-input label="Ulica" wire:model="invAddressForm.street" />
                    <x-input label="Nr domu" wire:model="invAddressForm.house_number" />
                    <x-input label="Nr mieszkania" wire:model="invAddressForm.apartment_number" />
                    <x-input label="Kod pocztowy" wire:model="invAddressForm.postal_code" />
                    <x-input label="Miasto" wire:model="invAddressForm.city" />
                    <x-input label="Województwo" wire:model="invAddressForm.province" />
                    <x-input label="Kraj" wire:model="invAddressForm.country" />
                    <x-button type="submit" primary>Zaktualizuj</x-button>
                </form>
            </div>
        </div>
    </div>
    <x-modal wire:model.defer="addressUpdateModal">
        <x-card title="Potwierdzenie">
            <p class="text-gray-600">
                Dane zostały pomyślnie zaktualizowane.
            </p>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button primary label="OK" wire:click="closeModal" />
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
                    <x-button primary label="OK" wire:click="closeModal" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
