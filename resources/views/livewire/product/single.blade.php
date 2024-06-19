<div class="px-3 md:px-6 max-w-screen-lg mx-auto">
    @php
        $name_column = "name_$lang";
    @endphp
    <x-button href='{{ route("products.$lang") }}' class="mx-2 mb-3">
        <x-icon name="arrow-left" class="w-4" />
        <span>{{ __('Lista produktów') }}</span>
    </x-button>
    <div class="flex justify-center gap-4 flex-wrap">
        <div>
            <img
                class="shadow-lg"
                src="{{ $product->images->first()->url ?? 'https://via.placeholder.com/640x480' }}"
                alt="{{ $product->$name_column }}"/>
        </div>
        <div class="basis-full lg:basis-1/4 flex flex-col gap-2">
            <div class="p-2 border rounded-md">
                <span
                    class="block text-sm text-zinc-500">{{ __('Nazwa produktu') }}</span>
                <h1 class="text-4xl font-bold">{{ $product->$name_column }}</h1>
            </div>
            <div class="p-2 border rounded-md">
                <span
                    class="block text-sm text-zinc-500">{{ __('Cena') }}</span>
                <p class="text-3xl font-bold">{{ number_format($variant->brutto_price, 2) }}
                    PLN</p>
            </div>
            <div class="p-2 border rounded-md">
                <span
                    class="block text-sm text-zinc-500">{{ __('Najniższa cena z ostatniego miesiąca') }}</span>
                <p class="text-2xl font-bold">{{ number_format($variant->brutto_price, 2) }}
                    PLN</p>
            </div>
            <div class="p-2 border rounded-md">
                <span
                    class="block text-sm text-zinc-500">{{ __('Wariant') }}</span>
                @foreach($variants as $availableVariant)
                    <x-button
                        class="text-2xl font-bold"
                        :href='$this->variantRoute($availableVariant->id)'>
                        <span>{{ __('Kolor') }}: {{ $availableVariant->color }},</span>
                        <span>{{ __('Rozmiar') }}: {{ $availableVariant->size }}</span>
                    </x-button>
                @endforeach
            </div>
            <div>
                <x-inputs.number wire:model="quantity"/>
                @if($variant->quantity <= 0)
                    <x-button disabled class="mt-2 w-full">
                        Brak produktu na stanie
                    </x-button>
                @else
                    <x-button wire:click="send" primary class="mt-2 w-full">
                        Dodaj do koszyka
                    </x-button>
                @endif
            </div>
        </div>
    </div>
</div>
