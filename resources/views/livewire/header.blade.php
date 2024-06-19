<header class="w-full bg-zinc-600 lg:h-16 fixed z-10 top-0 left-0 right-0">
    <div
        class="max-w-screen-lg h-full px-2 mx-auto flex items-stretch justify-center gap-4 flex-wrap lg:flex-nowrap">
        <button wire:click="toggle" class="lg:hidden flex gap-2 pl-2 pr-3 py-1 items-center justify-start fixed top-1 left-1 z-20 text-white">
            <x-icon name="{{ $menu ? 'x' : 'menu' }}" class="w-12" />
        </button>
        <div class="basis-full lg:basis-1/4 flex items-center justify-center lg:justify-start">
            <img src="/img/svg/Con_krzywe_bez_Srodkow.svg" alt="Logo - Conecta"
                 class="h-12 m-2 lg:m-0"/>
        </div>
        <div class="basis-full lg:basis-1/2 lg:block {{ $menu ? '' : 'hidden' }}">
            <nav
                class="h-full flex list-none flex-col lg:flex-row items-stretch justify-start lg:justify-center gap-1">
                <li class="{{ request()->path() === "$lang" ? "border-b-4 border-b-primary-600" : "" }} cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="{{ route("home.$lang") }}">{{ __('Strona główna') }}</a>
                </li>
                <li class="{{ request()->path() === "$lang/products" ? "border-b-4 border-b-primary-600" : "" }} cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="{{ route("products.$lang") }}">{{ __('Produkty') }}</a>
                </li>
                <li class="{{ request()->path() === "$lang/newsletter" ? "border-b-4 border-b-primary-600" : "" }} cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="{{ route("newsletter.$lang") }}">{{ __('Newsletter') }}</a>
                </li>
                <li class="{{ request()->path() === "$lang/blog" ? "border-b-4 border-b-primary-600" : "" }} cursor-pointer text-white rounded-md hover:bg-zinc-400 transition-colors my-2 h-12 px-4 flex items-center justify-center">
                    <a href="{{ route("blog.$lang") }}">{{ __('Blog') }}</a>
                </li>
            </nav>
        </div>
        <div class="{{ $menu ? 'flex' : 'hidden' }} mb-4 lg:mb-0 basis-full lg:basis-1/4 lg:flex justify-center lg:justify-end gap-4 lg:gap-2 items-center">
            <a class="{{ request()->path() === "$lang/profile" ? "border-b-[3px] border-b-primary-600 rounded-md" : "" }}" href="{{ auth()->id() ? route("profile.$lang") : route("login.$lang") }}">
                <x-icon name="user" solid color="white" class="h-8"/>
            </a>
            <a class="{{ request()->path() === "$lang/cart" ? "border-b-[3px] border-b-primary-600 rounded-md" : "" }}" href="{{ route("cart.$lang") }}">
                <x-icon name="shopping-cart" solid color="white" class="h-8"/>
            </a>
            <div class="flex gap-1">
                @foreach(config("lang.available_languages") as $availableLang)
                    @if($lang === $availableLang)
                        <a href="#">
                            <x-button disabled zinc
                                      class="uppercase">{{ $availableLang }}</x-button>
                        </a>
                    @else
                        <a href="{{ $urls[$availableLang] }}">
                            <x-button light primary
                                      class="uppercase">{{ $availableLang }}</x-button>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</header>
