<div class="max-w-screen-xl mx-auto w-full mt-8">
    <h1 class="max-w-screen-xl mx-auto text-4xl font-bold">Strefa B2B</h1>
    <div>
        <div class="flex gap-4 my-4 max-w-screen-xl mx-auto">
            @if ($tab === 'products')
                <x-button disabled>Produkty</x-button>
            @else
                <x-button wire:click="setTab('products')" primary>
                    Produkty
                </x-button>
            @endif
            @if ($tab === 'offers')
                <x-button disabled>Oferty</x-button>
            @else
                <x-button wire:click="setTab('offers')" primary>
                    Oferty
                </x-button>
            @endif
        </div>
        @if ($tab === 'offers')
            <div>
                <h2 class="text-2xl font-semibold max-w-screen-xl mx-auto">Moje oferty</h2>
                <div class="flex items-center justify-start gap-2 mt-4">
                    @foreach ($offers as $offer)
                        <x-card class="border rounded flex flex-col basis-[calc(50%-1rem)] w-full gap-2">
                            <h3 class="text-xl font-bold flex gap-x-2 items-center justify-start">Oferta #{{ $offer->id }}</h3>
                            @if ($offer->is_from_customer && $offer->parent_id !== null)
                                <x-badge purple>Moja kontroferta</x-badge>
                            @elseif ($offer->parent_id !== null)
                                <x-badge orange>Kontroferta</x-badge>
                            @endif
                            @if ($offer->childOffer !== null)
                                <x-badge indigo>Ma kontrofertę</x-badge>
                            @endif
                            @if ($offer->is_from_customer && $offer->rejected_at === null && $offer->accepted_at === null && $offer->childOffer === null)
                                <x-badge blue>Oczekuje na odpowiedź</x-badge>
                            @elseif ($offer->rejected_at !== null)
                                <x-badge red>Odrzucono</x-badge>
                            @elseif ($offer->accepted_at !== null)
                                <x-badge green>Zaakceptowano</x-badge>
                            @endif
                            @if ($offer->parent_id !== null)
                                <p class="py-2">Dotyczy oferty #{{ $offer->parent_id }}</p>
                            @else
                                <p class="py-2">Dotyczy {{ $offer->items()->count() ?? 0 }} produktów</p>
                            @endif
                            @if(!$offer->is_from_customer && $offer->childOffer === null)
                                <hr class="mb-2" />
                                <div class="flex flex-col gap-1">
                                    <span class="text-gray-500">Ostateczna oferta?</span>
                                    <span>{{ $offer->final ? 'Tak' : 'Nie' }}</span>
                                </div>
                            @endif
                            <x-slot name="footer" class="flex flex-row flex-wrap justify-between gap-2">
                                @if(!$offer->childOffer)
                                    <x-button class="basis-0 grow" blue :href="route('b2b.offer.'.$lang, ['offer' => $offer->id])">
                                        {{ __('Przejdź do oferty') }}
                                    </x-button>
                                @else
                                    <x-button class="basis-0 grow" indigo
                                        :href="route('b2b.offer.'.$lang, ['offer' => $offer->childOffer->id])">
                                        {{ __('Przejdź do złożonej kontroferty') }}
                                    </x-button>
                                @endif
                            </x-slot>
                        </x-card>
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
