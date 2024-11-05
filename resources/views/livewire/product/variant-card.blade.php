@php
    $name = "name_$lang";
    $slug = "slug_$lang";
@endphp
<div
    class="relative grow {{ $fill ? 'h-full' : '' }} max-w-full basis-full w-full border rounded-lg md:basis-[48%] xl:basis-[32%] flex flex-col justify-between items-center">
    <a class="h-full"
        href="{{ $url }}">
        <div class="p-4 flex flex-col h-full">
            @if ($product->is_customizable)
                <p class="absolute top-4 left-4 bg-zinc-700 text-white px-2 py-1">
                    Logo
                </p>
            @endif
            <img src="{{ $variant->product->images()->orderBy('display_position', 'asc')->first()->url ?? 'https://via.placeholder.com/320x240' }}"
                alt="{{ $product->$name }}" class="max-h-[180px] h-[180px] w-auto mx-auto object-scale-down" />
            <h3 class="text-lg font-bold mt-4 grow">{{ $product->$name }}</h3>
            <p
                class="{{ $variant->brutto_discount_price ? 'line-through text-red-700 text-sm' : 'font-bold' }} w-full text-right text-2xl">
                <span>{{ number_format($variant->brutto_price, 2) }}</span>
                <span>PLN</span>
            </p>
            @if ($variant->brutto_discount_price)
                <p class="font-bold w-full text-right text-2xl">
                    <span>{{ number_format($variant->brutto_discount_price, 2) }}</span>
                    <span>PLN</span>
                </p>
            @endif
            <div class="w-full">
                <div class="p-2 text-zinc-600 text-right">
                    <span class="block text-sm">{{ __('Dostępność') }}</span>
                    @if ($variant->quantity < 1)
                        <p class="text-lg font-bold">Wydłużony czas realizacji</p>
                    @elseif($variant->quantity < 10)
                        <p class="text-yellow-400 text-xl font-bold">Mała liczba sztuk</p>
                    @else
                        <p class="text-green-400 text-xl font-bold">Duża liczba sztuk</p>
                    @endif
                </div>
                <div class="flex items-stretch justify-center w-full gap-2">
                    @if (auth()->check() && $favorite)
                        <x-button type="button" secondary class="w-full mt-2 basis-full" wire:click="toggleFavorite">
                            <x-icon name="heart" class="w-6" solid color="primary" />
                            <span>Usuń z ulubionych</span>
                        </x-button>
                    @elseif(auth()->check() && !$favorite)
                        <x-button type="button" secondary class="w-full mt-2 basis-full" wire:click="toggleFavorite">
                            <x-icon name="heart" class="w-6" outline />
                            <span>Dodaj do ulubionych</span>
                        </x-button>
                    @else
                        <x-button disabled outline class="w-full mt-2 basis-full" href='{{ route("login.$lang") }}'>
                            <x-icon name="heart" class="w-6" outline />
                            <span>Zaloguj się, by dodać do ulubionych</span>
                        </x-button>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>
