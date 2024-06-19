<div class="h-min-max">
    <section class="w-full mt-4 min-h-full">
        <div class="text-center">
            <h1 class="text-primary-600 text-4xl">
                <b>{{ __('main.about_us') }}</b>
            </h1>
        </div>
        <div
            class="mt-6 max-w-screen-lg mx-auto px-14 lg:px-4 flex flex-col gap-4 items-end">
            <div class="flex items-center -gap-1">
                <p class="text-justify lg:text-right flex flex-col gap-2 lg:basis-2/3 lg:bg-primary-500 text-primary-700 lg:text-white p-4">
                    <span>{{ __('main.paragraph_1') }}</span>
                    <span>{{ __('main.paragraph_2') }}</span>
                    <span>{{ __('main.paragraph_3') }}</span>
                    <span>{{ __('main.paragraph_4') }}</span>
                    <span
                        class="{{ $more ? 'block' : 'hidden' }} lg:block">{{ __('main.paragraph_5') }}</span>
                    <span
                        class="{{ $more ? 'block' : 'hidden' }} lg:block">{{ __('main.paragraph_6') }}</span>
                    <span
                        class="{{ $more ? 'block' : 'hidden' }} lg:block">{{ __('main.paragraph_7') }}</span>
                </p>
                <img src="{{asset('img/banners/desktop1.png')}}" alt=""
                     class="hidden lg:block lg:basis-1/3 w-1/3">
            </div>
            <x-button wire:click="toggle" primary
                      class="lg:hidden">{{ $more ? __('Czytaj mniej') : __('Czytaj więcej') }}</x-button>
        </div>
        <div class="text-center mt-6">
            <h1 class="text-primary-600 text-4xl">
                <b>{{ __('main.products') }}</b>
            </h1>
        </div>
        <div class="max-w-screen-lg mx-auto">
            <livewire:product.categories mode="elements" />
        </div>
    </section>
</div>
