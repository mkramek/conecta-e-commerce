<div
    class="hover:shadow-md border rounded-lg p-4 flex flex-wrap gap-4 justify-between items-center">
    @php
        $name = "name_$lang";
        $slug = "slug_$lang";
    @endphp
    <div class="basis-1/2 flex items-center gap-4">
        <img
            alt="{{ $item->variant->$name }}"
            class="max-h-24 w-auto basis-1/6"
            src="{{ $item->product->images->first()->url ?? "https://via.placeholder.com/320x240" }}"
        />
        <div>
            <p>
                <a class="text-primary-600 hover:font-bold"
                   href="{{ route("product.$lang", ['id' => $item->product->id, 'slug' => $item->product->$slug, 'variant' => $item->variant->id]) }}">
                    {{ $item->product->$name }}
                </a>
            </p>
            <p class="flex flex-col text-xs text-zinc-400">
                <span>{{ __('kolor') }}: {{ $item->variant->color }}</span>
                <span>{{ __('rozmiar') }}: {{ $item->variant->size }}</span>
            </p>
        </div>
    </div>
    <div class="flex gap-1 basis-2/5 justify-end">
        <p class="{{ $discount_subtotal ? 'line-through text-red-700' : 'font-bold' }} flex">
            <span>{{ number_format($subtotal, 2) }}</span>
            <span>PLN</span>
        </p>
        @if($discount_subtotal)
            <p class="font-bold">
                <span>{{ number_format($discount_subtotal, 2) }}</span>
                <span>PLN</span>
            </p>
        @endif
    </div>
    <div class="flex gap-2 basis-full justify-end">
        <div class="basis-1/6">
            <x-inputs.number min="1" max="{{ $item->variant->quantity }}"
                             wire:model.live="item.quantity"
                             :value="$item->quantity"/>
        </div>
        <x-button red wire:click="confirm">
            <x-icon name="trash" class="w-6"/>
        </x-button>
    </div>
</div>
