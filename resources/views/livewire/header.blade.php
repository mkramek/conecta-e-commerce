<header class="w-full bg-zinc-600 z-10 sticky top-0 left-0 right-0">
    @php
        $name_column = "name_$lang";
        $slug_column = "slug_$lang";
    @endphp
    @if ($search)
        <div wire:click.self="toggleSearch"
            class="fixed flex justify-center items-center z-10 top-0 left-0 right-0 bg-black bg-opacity-70 text-3xl w-full h-full">
            <div class="min-w-96 min-h-96 bg-white rounded-xl w-[66%] h-[40rem] p-4">
            <div class="flex w-full justify-between items-center">
                <h1 class="mb-2">Wyszukiwanie</h1>
                <x-button class="mb-2" wire:click="toggleSearch">
                    <x-icon name="x" class="h-6" />
                </x-button>
            </div>
                <x-input full class="w-full" wire:model.live.debounce.500ms="query"
                    placeholder="Wprowadź nazwę produktu" />
                <div class="overflow-y-auto max-h-[32rem]">
                    <div class="flex gap-2 h-auto flex-wrap justify-stretch mb-4">
                        @if ($searchResults->isEmpty())
                            <p>{{ __('Brak wyników') }}</p>
                        @endif
                        @foreach ($searchResults as $result)
                            @php
                                $product_url = route("product.$lang", [
                                    'id' => $result->id,
                                    'slug' => $result->$slug_column,
                                ]);
                            @endphp
                            <a href='{{ $product_url }}'
                                class="flex items-center justify-start gap-1 w-full hover:bg-zinc-200 p-4 rounded-lg">
                                <img src="{{ $result->images()->orderBy('display_position', 'asc')->first()->url ?? 'https://via.placeholder.com/120x120' }}"
                                    class="w-auto h-28" />
                                <p class="text-lg">{{ $result->$name_column }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="max-w-screen-lg h-full px-2 mx-auto flex items-stretch justify-center gap-4 flex-wrap lg:flex-nowrap">
        <button wire:click="toggle"
            class="lg:hidden flex gap-2 pl-2 pr-3 py-1 items-center justify-start fixed top-1 left-1 z-20 text-white">
            <x-icon name="{{ $menu ? 'x' : 'menu' }}" class="w-12" />
        </button>
        <div class="basis-full lg:basis-1/4 flex items-center justify-center lg:justify-start">
            <img src="/img/svg/Con_krzywe_bez_Srodkow.svg" alt="Logo - Conecta" class="h-12 m-2 lg:m-0" />
        </div>
        <div class="basis-full lg:basis-1/2 lg:block {{ $menu ? '' : 'hidden' }}">
            <nav class="h-full flex list-none flex-col lg:flex-row items-stretch justify-start lg:justify-center gap-1">
                <li
                    class="{{ request()->path() === "$lang" ? 'border-b-4 border-b-primary-600' : '' }} cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="{{ route("home.$lang") }}">{{ __('Strona główna') }}</a>
                </li>
                <li
                    class="{{ request()->path() === "$lang/products" ? 'border-b-4 border-b-primary-600' : '' }} cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="{{ route("products.$lang") }}">{{ __('Produkty') }}</a>
                </li>
                <li
                    class="{{ request()->path() === "$lang/newsletter" ? 'border-b-4 border-b-primary-600' : '' }} cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="{{ route("newsletter.$lang") }}">{{ __('Newsletter') }}</a>
                </li>
                <li
                    class="{{ request()->path() === "$lang/blog" ? 'border-b-4 border-b-primary-600' : '' }} cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="{{ route("blog.$lang") }}">{{ __('Blog') }}</a>
                </li>
                <li
                    class="cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <button wire:click="toggleSearch">
                        <x-icon name="search" class="h-6" />
                    </button>
                </li>
            </nav>
        </div>
        <div
            class="{{ $menu ? 'flex' : 'hidden' }} mb-4 lg:mb-0 basis-full lg:basis-1/4 lg:flex justify-center lg:justify-end gap-4 lg:gap-2 items-center">
            <a class="{{ request()->path() === "$lang/profile" ? 'border-b-[3px] border-b-primary-600 rounded-md' : '' }}"
                href="{{ auth()->check() ? route("profile.$lang") : route("login.$lang") }}">
                <x-icon name="user" solid color="white" class="h-8" />
            </a>
            <a class="{{ request()->path() === "$lang/cart" ? 'border-b-[3px] border-b-primary-600 rounded-md' : '' }} relative"
                href="{{ route("cart.$lang") }}">
                <x-icon name="shopping-cart" solid color="white" class="h-8" />
                @if ($cart_count)
                    <span
                        class="absolute top-0 right-0 text-sm rounded-full bg-red-600 text-white w-4 h-4 flex justify-center items-center">{{ $cart_count }}</span>
                @endif
            </a>
            <div class="flex gap-1">
                @foreach (config('lang.available_languages') as $availableLang)
                    @if ($lang === $availableLang)
                        <a href="#">
                            <x-button disabled primary class="uppercase">{{ $availableLang }}</x-button>
                        </a>
                    @else
                        <a href="{{ $urls[$availableLang] }}">
                            <x-button light zinc class="uppercase">{{ $availableLang }}</x-button>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</header>
