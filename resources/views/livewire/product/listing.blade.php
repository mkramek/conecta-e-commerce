<div>
    <div class="flex flex-col flex-wrap md:flex-row justify-start md:justify-evenly px-4">
        <div class="lg:basis-1/3 xl:basis-1/4 basis-full p-2 pb-4 m-0 bg-zinc-600 text-white">
            <form class="mt-4 flex flex-col gap-4 justify-start items-start">
                <h2 class="text-2xl">{{ __('Kategorie') }}</h2>
                <div>
                    <livewire:product.categories />
                </div>
                <h2 class="text-2xl">{{ __('Filtry') }}</h2>
                <x-select name="filters_producer" label="{{ __('Producent') }}" id="filters_producer"
                    wire:model.live="filters.producer" empty-message="{{ __('Brak producentów') }}" class="dark">
                    @foreach ($producers as $prd)
                        <x-select.option value="{{ $prd->id }}">{{ $prd->name }}</x-select.option>
                    @endforeach
                </x-select>
                <x-select name="filters_availability" label="{{ __('Dostępność') }}" id="filters_availability"
                    wire:model.live="filters.availability" class="dark">
                    <x-select.option value="1">Tak</x-select.option>
                    <x-select.option value="0">Nie</x-select.option>
                </x-select>
                <div class="flex gap-4 justify-between items-start dark">
                    <x-inputs.currency label="Cena od" suffix="PLN"
                        wire:model.live.debounce.250ms="filters.price_min" />
                    <x-inputs.currency label="Cena do" suffix="PLN"
                        wire:model.live.debounce.250ms="filters.price_max" />
                </div>
            </form>
            <div class="mt-4">
                <h2 class="text-2xl">{{ __('Masz pytanie?') }}</h2>
                <x-button class="mt-2 w-full bg-primary-500 " href='{{ route("contact.$lang") }}'>
                    <p class="text-white font-bold">Zapytaj o przedmiot</p>
                </x-button>
            </div>
        </div>
        <div class="basis-full lg:basis-2/3 xl:basis-3/4 flex flex-wrap justify-center gap-4 w-full py-4">
            @foreach ($products as $product)
                <livewire:product.variant-card wire:key="{{ $product->id }}" :$product />
            @endforeach
            <div class="w-full px-8">
                {{ $products->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
</div>
