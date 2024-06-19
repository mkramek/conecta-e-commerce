<div class="max-w-screen-lg mx-auto">
    <div class="py-4 px-8">
        <h1 class="text-4xl">Koszyk</h1>
    </div>
    <div class="flex flex-col gap-4">
        @foreach($items as $item)
            <livewire:customer.cart-item wire:key="{{ $item->id }}"
                                         :item="$item"/>
        @endforeach
    </div>
    <div class="text-right mt-4">
        <p>Suma:</p>
        <p class="text-3xl font-bold">
            <span>{{ number_format($total_brutto, 2) }}</span>
            <span>PLN</span>
        </p>
        <div class="mt-4">
            <x-button href='{{ route("products.$lang") }}'>
                Powrót do zakupów
            </x-button>
            <x-button primary href='{{ route("checkout.$lang") }}'>
                Przejdź do podsumowania
            </x-button>
        </div>
    </div>
</div>
