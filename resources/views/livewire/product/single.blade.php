<div class="max-w-screen-lg mx-auto flex">
    @php
        $name_column = "name_$lang";
        $desc_column = "description_$lang";
    @endphp
    <div class="basis-full lg:basis-2/3 my-8">
        <x-button href='{{ route("products.$lang") }}' class="mx-2 mb-3">
            <x-icon name="arrow-left" class="w-4"/>
            <span>{{ __('Lista produktów') }}</span>
        </x-button>
        <h1 class="text-4xl font-bold">{{ $product->$name_column }}</h1>
        <p class="flex justify-between pr-12">
            <span>{{ __('Producent') }}: {{ $product->producer }}</span>
            <span>{{ __('Kod') }}: {{ $product->symfonia_id }}</span>
        </p>
        <div class="pr-12">
            <livewire:shared.image-slider
                :images="$product->images"
                product-name="{{ $product->$name_column }}"
            />
        </div>
        <h2 class="mt-4 text-2xl font-bold">{{ __('Opis produktu') }}</h2>
        <div>{!! $meta->base_description ?? 'Brak opisu.' !!}</div>
    </div>
    <div class="flex bg-zinc-600 basis-full lg:basis-1/3 pt-40">
        <div class="basis-full flex flex-col gap-2">
            <div class="p-2 text-primary-500 text-right">
                <span
                    class="block text-sm">{{ __('Cena') }}</span>
                <p class="text-3xl font-bold">
                    <span>{{ number_format($selected->brutto_price, 2) }}</span>
                    <span>PLN</span>
                </p>
            </div>
            <div class="p-2 text-zinc-400 text-right">
                <span
                    class="block text-sm">{{ __('Najniższa cena z 30 dni przed obniżką') }}</span>
                <p class="text-2xl font-bold">{{ number_format($last_price, 2) }}
                    PLN</p>
            </div>
            <div class="px-2">
                <x-select
                    class="mb-4"
                    placeholder="Wybierz wariant"
                    :searchable="false"
                    empty-message="Brak wariantów"
                    wire:change="changeVariant($event.detail.value)"
                    wire:model.live="variant"
                >
                    @foreach($variants as $availableVariant)
                        @php
                            $label = "";
                            $label .= $availableVariant->color === "BRAK" ? "Bez koloru" : $availableVariant->color;
                            $label .= ", ";
                            $label .= $availableVariant->size === "0" ? "Bez rozmiaru" : "rozmiar: {$availableVariant->size}";
                        @endphp
                        <x-select.option
                            :disabled="$selected->id === $availableVariant->id"
                            :label="$label"
                            :value="$availableVariant->id"
                        />
                    @endforeach
                </x-select>
                <x-inputs.number wire:model="quantity"/>
                @if($selected->quantity <= 0)
                    <x-button disabled secondary class="mt-2 w-full">
                        Brak produktu na stanie
                    </x-button>
                @else
                    <x-button wire:click="send" primary class="mt-2 w-full">
                        Dodaj do koszyka
                    </x-button>
                @endif
            </div>
        </div>
    </div>
</div>
