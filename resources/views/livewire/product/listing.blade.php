<div>
    <h1 class="px-8 text-4xl">{{ __('Produkty') }}</h1>
    <div class="flex flex-col flex-wrap md:flex-row justify-start md:justify-evenly px-4">
        <div
            class="lg:basis-1/3 xl:basis-1/4 mt-4 basis-full border rounded-md shadow-md p-4">
            <h2 class="text-2xl">{{ __('Filtry') }}</h2>
            <form class="mt-4 flex flex-col gap-4 justify-start items-start">
                <div>
                    <p class="text-[.9rem]">{{ __('Kategorie') }}</p>
                    <livewire:product.categories />
                </div>
                <x-select name="filters_producer"
                          label="{{ __('Producent') }}"
                          id="filters_producer"
                          wire:model.live="filters.producer"
                          empty-message="{{ __('Brak producentów') }}">
                    @foreach($producers as $prd)
                        <x-select.option
                            value="{{ $prd->id }}">{{ $prd->name }}</x-select.option>
                    @endforeach
                </x-select>
                <x-select name="filters_availability"
                          label="{{ __('Dostępność') }}"
                          id="filters_availability"
                          wire:model.live="filters.availability">
                    <x-select.option value="1">Tak</x-select.option>
                    <x-select.option value="0">Nie</x-select.option>
                </x-select>
                <div class="flex gap-4 justify-between items-start">
                    <x-inputs.currency label="Cena od"
                                       suffix="PLN"
                                       wire:model.live.debounce.250ms="filters.price_min"/>
                    <x-inputs.currency label="Cena do"
                                       suffix="PLN"
                                       wire:model.live.debounce.250ms="filters.price_max"/>
                </div>
            </form>
        </div>
        <div class="basis-full lg:basis-2/3 xl:basis-3/4 flex flex-wrap justify-center gap-4 w-full py-4">
            @foreach($products as $product)
                <livewire:product.variant-card :key="$product->id"
                                               :product="$product"/>
            @endforeach
            <div class="w-full px-8">
                {{ $products->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
</div>
