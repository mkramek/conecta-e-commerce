<div class="max-w-screen-xl mx-auto w-full mt-8">
    <h1 class="max-w-screen-xl mx-auto text-4xl font-bold">Strefa B2B</h1>
    <div>
        <div class="flex gap-4 my-4 max-w-screen-xl mx-auto">
            @if ($tab === 'products')
                <x-button disabled>Produkty</x-button>
            @else
                <x-button wire:click="setTab('products')" primary>Produkty</x-button>
            @endif
            @if ($tab === 'offers')
                <x-button disabled>Oferty</x-button>
            @else
                <x-button wire:click="setTab('offers')" primary>Oferty</x-button>
            @endif
        </div>
        @if ($tab === 'offers')
            <div>
                <h2 class="text-2xl font-semibold max-w-screen-xl mx-auto">Moje oferty</h2>
                <div class="flex">
                    @foreach ($offers as $offer)
                        <div class="border rounded px-3 py-1 flex flex-col basis-1/2 w-full max-w-[50%] gap-2">
                            <h3 class="text-xl font-bold">Oferta #{{ $offer->id }}</h3>
                            <span>Dotyczy {{ $offer->items()->count() ?? 0 }} produktów</span>
                            <div class="flex flex-col gap-1">
                                <span class="text-gray-500">Odrzucona przez sklep?</span>
                                <span>{{ !is_null($offer->rejected_at) ? 'Tak' : 'Nie' }}</span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-gray-500">Ostateczna oferta?</span>
                                <span>{{ $offer->final ? 'Tak' : 'Nie' }}</span>
                            </div>
                            <div class="flex flex-row flex-wrap justify-between gap-2">
                                <x-button class="basis-0 grow" blue>Przejdź do oferty</x-button>
                                <x-button class="basis-0 grow" green>Zatwierdź ofertę</x-button>
                                <x-button class="basis-0 grow" orange>Złóż kontrofertę</x-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif ($tab === 'products')
            <div>
                <h2 class="text-2xl font-semibold max-w-screen-xl mx-auto">Produkty</h2>
                <livewire:profile.products-table />
            </div>
        @endif
    </div>
</div>
