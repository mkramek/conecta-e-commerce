<div class="hover:shadow-md border rounded-lg p-4 flex flex-col md:flex-row items-center">
    @php
        $name = "name_$lang";
        $slug = "slug_$lang";
    @endphp

    <div class="basis-1/6 p-2">
        <img alt="{{ $item->variant->$name }}" class="max-h-24 w-auto basis-1/6"
            src="{{ $item->product->images->first()->url ?? 'https://via.placeholder.com/320x240' }}" />
    </div>
    <div class="flex flex-col basis-1/3 p-2">
        <p>
            <a class="text-primary-600 hover:font-bold"
                href="{{ route("product.$lang", ['id' => $item->product->id, 'slug' => $item->product->$slug, 'variant' => $item->variant->id]) }}">
                {{ $item->product->$name }}
            </a>
        </p>
        <p class="flex flex-col text-xs text-zinc-400">
            <span>{{ __('kolor') }}: {{ $item->variant->color }}</span>
            <span>{{ __('rozmiar') }}: {{ $item->variant->size }}</span>
            <span>{{ __('Niestandardowy') }}: {{ $item->is_customizable ? 'Tak' : 'Nie' }}</span>
        </p>
    </div>
    <div class="basis-1/6 p-2">
        <p class="font-bold flex">
            <span>{{ number_format($item->variant->brutto_price, 2) }}</span>
            <span>PLN/szt</span>
        </p>
    </div>
    <div class="basis-1/6 p-2">
        <x-inputs.number min="0" step="{{ $item->variant->product->step }}" wire:model.live="item.quantity"
            :value="$item->quantity" />
    </div>
    <div class="basis-1/6 p-2">
        <p class="{{ $discount_subtotal ? 'line-through text-red-700' : 'font-bold' }} flex">
            <span>{{ number_format($subtotal, 2) }}</span>
            <span>PLN</span>
        </p>
        @if ($discount_subtotal)
            <p class="font-bold">
                <span>{{ number_format($discount_subtotal, 2) }}</span>
                <span>PLN</span>
            </p>
        @endif
    </div>
    <div class="basis-1/12 p-2">
        <x-button red wire:click="confirm">
            <x-icon name="trash" class="w-6" />
        </x-button>
    </div>
</div>
