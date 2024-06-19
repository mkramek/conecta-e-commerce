<div class="max-w-screen-lg mx-auto">
    <div class="flex w-full justify-between items-center">
        <h1 class="text-4xl font-bold">{{ __('Profil') }}</h1>
        <x-button icon="logout" label="{{ __('Wyloguj się') }}" secondary/>
    </div>
    <div class="flex flex-wrap mt-6 gap-4">
        <div class="basis-full lg:basis-[35%]">
            <h2 class="text-2xl">{{ __('Zamówienia') }}</h2>
            @if($orders->isEmpty())
                <p class="text-lg mt-6 italic">{{ __('Brak zamówień') }}</p>
            @else
                <div class="mt-6 flex flex-col gap-4">
                    @foreach($orders as $order)
                        <div class="border rounded p-2">
                            <p class="text-xs">{{ (new \Carbon\Carbon($order->created_at))->format("d.m.Y H:i") }}</p>
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
                                @if($order->payment_id)
                                    <x-button info href="{{ $order->payment_url }}">
                                        Link do płatności
                                    </x-button>
                                @else
                                    <x-button
                                        info
                                        href='{{ route("order.payment.transfer.{$this->lang}", ["order_id" => $order->id]) }}'>
                                        Link do płatności
                                    </x-button>
                                @endif
                                @if($order->tracking_id)
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
        <div class="basis-full lg:basis-3/5">
            <h2 class="text-2xl">{{ __('Ulubione') }}</h2>
            <div class="flex flex-col gap-4 mt-6">
                @foreach($favorites as $favorite)
                    @php
                        $variant = $favorite->variant;
                        $product = $variant->product;
                        $name = "name_$lang";
                        $slug = "slug_$lang";
                    @endphp
                    <div
                        class="flex gap-4 items-center justify-between p-2 border rounded">
                        <img
                            src='{{ $product->images->first()->url ?? "https://via.placeholder.com/320x240" }}'
                            alt='{{ $product->$name }}' class="max-h-24"/>
                        <p class="basis-1/3">{{ $product->$name }}</p>
                        <x-button
                            class="basis-1/3"
                            href='{{ route("product.$lang", ["slug" => $product->$slug, "id" => $product->id, "variant" => $variant->id]) }}'>{{ __('Przejdź do produktu') }}</x-button>
                        <x-button red wire:click="remove({{ $favorite->id }})">
                            <x-icon name="trash" class="w-5"/>
                        </x-button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
