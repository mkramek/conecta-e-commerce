<div
    class="relative max-w-full basis-full w-full border rounded-lg p-4 md:basis-[48%] xl:basis-[32%] flex flex-col justify-between items-center px-4">
    @php
        $name = "name_$lang";
        $slug = "slug_$lang";
    @endphp
    @if($variant->quantity < 1)
        <p class="absolute top-4 left-4 bg-zinc-700 text-white px-2 py-1">
            Niedostępny
        </p>
    @endif
    <img
        src="{{ $variant->product->images->first()->url ?? "https://via.placeholder.com/320x240" }}"
        alt="{{ $product->$name }}"/>
    <h3 class="text-lg font-bold mt-4">{{ $product->$name }}</h3>
    <p class="{{ $variant->brutto_discount_price ? 'line-through text-red-700 text-sm' : 'font-bold' }} w-full text-right text-2xl">
        <span>{{ number_format($variant->brutto_price, 2) }}</span>
        <span>PLN</span>
    </p>
    @if($variant->brutto_discount_price)
        <p class="font-bold w-full text-right text-2xl">
            <span>{{ number_format($variant->brutto_discount_price, 2) }}</span>
            <span>PLN</span>
        </p>
    @endif
    <div class="w-full">
        <x-button class="w-full mt-4"
                  href="{{ route('product.'.$lang, ['id' => $product->id, 'slug' => $product->$slug, 'variant' => $variant->id]) }}">
            Pokaż przedmiot
        </x-button>
        <div class="flex items-stretch justify-center w-full gap-2">
            @if(auth()->id() && $favorite)
                <x-button outline class="mt-2 basis-1/4"
                          wire:click="toggleFavorite">
                    <x-icon name="heart" class="w-6" solid color="primary"/>
                </x-button>
            @elseif(!$favorite)
                <x-button outline class="mt-2 basis-1/4"
                          wire:click="toggleFavorite">
                    <x-icon name="heart" class="w-6" outline/>
                </x-button>
            @else
                <x-button outline class="mt-2 basis-1/4"
                          href='{{ route("login.$lang") }}'>
                    <x-icon name="heart" class="w-6" outline/>
                </x-button>
            @endif
            @if($variant->quantity > 1)
                <x-button primary class="mt-2 basis-1/4"
                          wire:click="addToCart">
                    <x-icon name="shopping-cart" solid class="w-6"/>
                </x-button>
            @else
                <x-button disabled slate class="mt-2 basis-1/2"
                          wire:click="addToCart">
                    <x-icon name="shopping-cart" solid class="w-6"/>
                </x-button>
            @endif
            <div class="flex items-center mt-2 basis-1/2">
                <x-inputs.number id="product-quantity-{{ $variant->id }}"
                                 wire:model="quantity" min="0"
                                 value="0"
                                 max="{{ $variant->quantity }}"></x-inputs.number>
            </div>
        </div>
    </div>
</div>
