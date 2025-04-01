<div class="max-w-screen-xl mx-auto w-full mt-8">
    <h1 class="max-w-screen-xl mx-auto text-4xl font-bold">Oferta B2B</h1>
    <p class="ml-1">ID: {{ $offer->id }}</p>
    <div class="my-4">
        @if ($offer->childOffer !== null)
            <x-button gray disabled
                      :href="route('b2b.offer.'.$lang, ['offer' => $offer->childOffer->id])">
                Przejdź do złoźonej kontroferty
            </x-button>
        @elseif ($counter !== null && !$offer->is_from_customer)
            <x-button green wire:click="sendCounterOffer">
                Zatwierdź kontrofertę
            </x-button>
            <x-button red wire:click="cancelCounterOffer">
                Anuluj kontrofertę
            </x-button>
        @elseif ($offer->is_from_customer && $offer->accepted_at !== null)
            <x-button green wire:click="approveOffer">
                Dodaj do koszyka
            </x-button>
        @elseif (!$offer->is_from_customer)
            <x-button green wire:click="approveOffer">
                Zatwierdź ofertę i dodaj do koszyka
            </x-button>
            @if(!$offer->is_final)
                <x-button orange wire:click="counterOffer">
                    Złóż kontrofertę
                </x-button>
            @endif
            <x-button red wire:click="rejectCounterOffer">
                Odrzuć ofertę
            </x-button>
        @elseif ($offer->is_from_customer && $offer->accepted_at === null)
            <x-button gray disabled>Oczekuje na odpowiedź</x-button>
        @endif
    </div>
    @if ($counter === null)
        <div class="mt-8">
            <h2 class="text-xl mb-1">Produkty objęte ofertą</h2>
            <table class="table-auto border-collapse border">
                <thead>
                <tr>
                    <th class="border p-1">ID</th>
                    <th class="border p-1">Nazwa</th>
                    <th class="border p-1">Ilość</th>
                    <th class="border p-1">Cena jednostkowa netto</th>
                    <th class="border p-1">Cena jednostkowa brutto</th>
                </tr>
                </thead>
                <tbody>
                @foreach($offer->items as $item)
                    <tr>
                        <td class="border p-1">{{ $item->product_variant_id }}</td>
                        <td class="border p-1">{{ $item->variant->name_pl }}</td>
                        <td class="border p-1">{{ $item->quantity }}</td>
                        <td class="border p-1 text-right">
                            {{ $item->price_net }} PLN
                        </td>
                        <td class="border p-1 text-right">
                            {{ $item->price_gross }} PLN
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    @php
                        $totals_net = collect($offer->items->map(fn($item) => $item->quantity * $item->price_net))->sum();
                        $totals_gross = collect($offer->items->map(fn($item) => $item->quantity * $item->price_gross))->sum();
                    @endphp
                    <td class="font-bold uppercase text-xs text-center border p-1"
                        colspan="3">Suma
                    </td>
                    <td class="border p-1 text-right font-bold">{{ number_format($totals_net, 2, ".", " ") }}
                        PLN
                    </td>
                    <td class="border p-1 text-right font-bold">{{ number_format($totals_gross, 2, ".", " ") }}
                        PLN
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    @else
        <div class="mt-8">
            <h2 class="text-xl mb-1">Produkty objęte ofertą</h2>
            <table class="table-auto border-collapse border">
                <thead>
                <tr>
                    <th class="border p-1">ID</th>
                    <th class="border p-1">Nazwa</th>
                    <th class="border p-1">Ilość</th>
                    <th class="border p-1">Cena jednostkowa netto</th>
                    <th class="border p-1">Cena jednostkowa brutto</th>
                </tr>
                </thead>
                <tbody>
                @foreach($counter_items as $key => $item)
                    <tr>
                        <td class="border p-1">{{ $item->product_variant_id }}</td>
                        <td class="border p-1">{{ $item->variant->name_pl }}</td>
                        <td class="border p-1">
                            <x-input type="number" step="1"
                                     wire:model.live.debounce.250ms="counter_items.{{ $key }}.quantity"/>
                        </td>
                        <td class="border p-1 text-right">
                            <x-input type="number" step="0.01"
                                     wire:model.live.debounce.250ms="counter_items.{{ $key }}.price_net"
                                     suffix="PLN"/>
                        </td>
                        <td class="border p-1 text-right">
                            <x-input type="number" step="0.01"
                                     wire:model.live.debounce.250ms="counter_items.{{ $key }}.price_gross"
                                     suffix="PLN"/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    @php
                        $totals_net = collect($counter_items->map(fn($item) => intval($item->quantity) * floatval($item->price_net)))->sum();
                        $totals_gross = collect($counter_items->map(fn($item) => intval($item->quantity) * floatval($item->price_gross)))->sum();
                    @endphp
                    <td class="font-bold uppercase text-xs text-center border p-1"
                        colspan="3">Suma
                    </td>
                    <td class="border p-1 text-right font-bold">{{ number_format($totals_net, 2, ".", " ") }}
                        PLN
                    </td>
                    <td class="border p-1 text-right font-bold">{{ number_format($totals_gross, 2, ".", " ") }}
                        PLN
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    @endif
</div>
