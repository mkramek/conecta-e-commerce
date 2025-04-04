<div class="max-w-screen-xl mx-auto flex flex-col lg:flex-row">
    @php
        $name_column = "name_$lang";
        $desc_column = "description_$lang";
    @endphp
    <div class="lg:basis-1/4 basis-full p-2 pb-4 m-0 bg-zinc-600 text-white">
        <form class="mt-4 flex flex-col gap-4 justify-start items-start">
            <h2 class="text-2xl">{{ __('Kategorie') }}</h2>
            <div>
                <livewire:product.categories />
            </div>
        </form>
    </div>
    <div class="basis-full lg:basis-1/2 my-8 px-4">
        <x-button href='{{ route("products.$lang") }}' class="mx-2 mb-3">
            <x-icon name="arrow-left" class="w-4" />
            <span>{{ __('Lista produktów') }}</span>
        </x-button>
        {{ $product->size }}
        <h1 class="text-4xl font-bold">{{ $product->$name_column }}</h1>
        <p class="flex justify-between pr-12">
            <span>{{ __('Producent') }}: {{ $product->producer }}</span>
            <span>{{ __('Kod') }}: {{ $product->symfonia_id }}</span>
        </p>
        <div class="max-w-[50rem]">
            <div class="swiper images-swiper">
                <div class="swiper-wrapper">
                    @foreach ($images as $image)
                        <div wire:key="{{ $image->url }}" class="swiper-slide">
                            <img class="mx-auto" src="{{ $image->url }}" alt="{{ $product->$name_column }}" />
                        </div>
                    @endforeach
                </div>
                <div class="images-swiper-pagination after:!text-primary-500"></div>
                <div class="swiper-button-prev after:!text-primary-500"></div>
                <div class="swiper-button-next after:!text-primary-500"></div>
            </div>
        </div>
        <h2 class="mt-4 text-2xl mb-2 font-bold">{{ __('Opis produktu') }}</h2>
        <div>{!! $meta->base_description ?? 'Brak opisu.' !!}</div>
        @if (count($similar) > 0)
            <div class="max-w-full">
                <h2 class="text-2xl mb-4 text-center font-bold">{{ __('Sprawdź też podobne produkty') }}</h2>
                <div class="w-[48rem] overflow-x-auto">
                    <div class="flex flex-row gap-4 justify-start items-stretch">
                        <div class="swiper products-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($similar as $similarItem)
                                    <div wire:key="{{ $similarItem->id }}" class="swiper-slide">
                                        <livewire:product.variant-card :key="$similarItem->id" :product="$similarItem" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-prev after:!text-primary-500"></div>
                            <div class="swiper-button-next after:!text-primary-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="bg-zinc-600 basis-full lg:basis-1/4 pt-40">
        <div class="basis-full flex flex-col gap-2 px-4">
            <div class="p-2 text-primary-500 text-right">
                <span class="block text-sm">{{ __('Cena brutto') }}</span>
                <p class="text-3xl font-bold">
                    <span>{{ number_format($selected->brutto_price, 2) }}</span>
                    <span>PLN</span>
                </p>
            </div>
            <div class="p-2 text-primary-500 text-right">
                <span class="block text-sm">{{ __('Cena netto') }}</span>
                <p class="text-xl font-bold">
                    <span>{{ number_format($selected->netto_price, 2) }}</span>
                    <span>PLN</span>
                </p>
            </div>
            <div class="p-2 text-zinc-400 text-right">
                <span class="block text-sm">{{ __('Najniższa cena z 30 dni przed obniżką') }}</span>
                <p class="text-2xl font-bold">{{ number_format($last_price, 2) }}
                    PLN</p>
            </div>
            <div class="p-2 text-zinc-400 text-right">
                <span class="block text-sm">{{ __('Dostępność') }}</span>
                @if ($selected->quantity < 1)
                    <p class="text-2xl font-bold">{{ __('Wydłużony czas realizacji') }}</p>
                @elseif($selected->quantity < 10)
                    <p class="text-2xl font-bold">{{ __('Mała liczba sztuk') }}</p>
                @else
                    <p class="text-2xl font-bold">{{ __('Duża liczba sztuk') }}</p>
                @endif
            </div>
            <div class="px-2">
                @if (count($availableColors) > 1)
                    <div>
                        <label for="product-variant-color-select" class="mb-1 text-white text-sm">Wybierz kolor</label>
                        <x-select
                            id="product-variant-color-select"
                            class="mb-2"
                            placeholder="Wybierz kolor"
                            :searchable="false"
                            empty-message="Brak kolorów"
                            wire:model.live="color_id"
                        >
                            @foreach ($availableColors as $color)
                                @php
                                    $label = $color->name === 'BRAK' ? 'Bez koloru' : $color->name;
                                @endphp
                                <x-select.option
                                    :key="$color->id"
                                    :disabled="$color->name === $color_id"
                                    :label="$label"
                                    :value="$color->name"
                                />
                            @endforeach
                        </x-select>
                    </div>
                @endif
                @if (count($availableSizes) > 1)
                    <div>
                        <label for="product-variant-size-select" class="mb-1 text-white text-sm">Wybierz rozmiar</label>
                        <x-select
                            id="product-variant-size-select"
                            class="mb-4"
                            placeholder="Wybierz rozmiar"
                            :searchable="false"
                            empty-message="Brak rozmiarów"
                            wire:model.live="size_id"
                        >
                            @foreach ($availableSizes as $size)
                                @php
                                    $label = $size->size_value === 0 ? 'Bez rozmiaru' : $size->size_value;
                                @endphp
                                <x-select.option
                                    :key="$size->size_value"
                                    :disabled="$size->size_value === $size_id"
                                    :$label
                                    :value="$size->size_value"
                                />
                            @endforeach
                        </x-select>
                    </div>
                @endif
                <form wire:submit="addToCart">
                    <label for="product-variant-quantity-select" class="mb-1 text-white text-sm">Ilość</label>
                    <x-input
                        id="product-variant-quantity-select"
                        type="number"
                        min="1"
                        step="{{ $product->step }}"
                        wire:model="quantity"
                    />
                    @if ($selected->product->is_customizable)
                        <div class="flex justify-start items-start gap-2 mb-2 mt-4">
                            <x-checkbox class="p-2 my-4" id="customization" wire:model="will_customize" />
                            <label class="text-white" for="customization">{{ __('Chcę umieścić niestandardową grafikę') }}</label>
                        </div>
                    @endif
                    @if ($selected->quantity <= 0)
                        <x-button type="submit" warning class="mt-2 w-full">
                            {{ __('Dodaj do koszyka (wydłużona realizacja)') }}
                        </x-button>
                    @else
                        <x-button type="submit" primary class="mt-2 w-full">
                            {{ __('Dodaj do koszyka') }}
                        </x-button>
                    @endif
                </form>
                @if (auth()->check() && $favorite)
                    <x-button
                        primary
                        white
                        class="w-full mt-2 basis-full"
                        wire:click="toggleFavorite"
                    >
                        <x-icon
                            name="heart"
                            class="w-6"
                            solid
                            color="primary"
                        />
                        <span>{{ __('Usuń z ulubionych') }}</span>
                    </x-button>
                @elseif(auth()->check() && !$favorite)
                    <x-button secondary class="w-full mt-2 basis-full" wire:click="toggleFavorite">
                        <x-icon name="heart" class="w-6" outline />
                        <span>{{ __('Dodaj do ulubionych') }}</span>
                    </x-button>
                @else
                    <x-button
                        disabled
                        white
                        class="w-full mt-2 basis-full"
                        href='{{ route("login.$lang") }}'
                    >
                        <x-icon name="heart" class="w-6" outline />
                        <span>{{ __('Zaloguj się, by dodać do ulubionych') }}</span>
                    </x-button>
                @endif
            </div>
        </div>
    </div>
</div>

@script
    <script>
        const productsSwiper = new window.Swiper('.swiper.products-swiper', {
            slidesPerView: 2,
            spaceBetween: 5,
            navigation: true,
        });

        document.querySelector(".products-swiper .swiper-button-prev").addEventListener("click", () => {
            productsSwiper.slidePrev();
        });

        document.querySelector(".products-swiper .swiper-button-next").addEventListener("click", () => {
            productsSwiper.slideNext();
        });

        const imagesSwiper = new window.Swiper('.swiper.images-swiper', {
            slidesPerView: 1,
            navigation: true,
            pagination: {
                el: ".images-swiper-pagination",
                clickable: true,
            },
        });

        document.querySelector(".images-swiper .swiper-button-prev").addEventListener("click", () => {
            imagesSwiper.slidePrev();
        });

        document.querySelector(".images-swiper .swiper-button-next").addEventListener("click", () => {
            imagesSwiper.slideNext();
        });
    </script>
@endscript
