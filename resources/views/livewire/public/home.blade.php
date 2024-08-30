<div class="h-min-max">
    <section class="w-full mt-4 min-h-full">
{{--        <div class="text-center">--}}
{{--            <h1 class="text-primary-600 text-4xl mb-12">--}}
{{--                <b>{{ __('main.about_us') }}</b>--}}
{{--            </h1>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <div class="w-screen min-h-24 bg-[#f1b273]">--}}
{{--                <div class="mx-auto max-w-screen-xl flex mb-16 gap-16">--}}
{{--                    <p class="w-screen font-bold text-justify lg:text-right flex flex-col gap-2 bg-[#f1b273] text-black px-4 py-16">--}}
{{--                        <span>{{ __('main.paragraph_1') }}</span>--}}
{{--                        <span>--}}
{{--                            {{ __('main.paragraph_2') }}--}}
{{--                            {{ __('main.paragraph_3') }}--}}
{{--                        </span>--}}
{{--                        <span>{{ __('main.paragraph_4') }}</span>--}}
{{--                        <span--}}
{{--                            class="{{ $more ? 'block' : 'hidden' }} lg:block">{{ __('main.paragraph_5') }}</span>--}}
{{--                        <span--}}
{{--                            class="{{ $more ? 'block' : 'hidden' }} lg:block">{{ __('main.paragraph_6') }}</span>--}}
{{--                        <span--}}
{{--                            class="{{ $more ? 'block' : 'hidden' }} lg:block">{{ __('main.paragraph_7') }}</span>--}}
{{--                    </p>--}}
{{--                    <img src="{{asset('img/banners/desktop1.png')}}" alt=""--}}
{{--                         class="hidden lg:block h-[34rem] -my-12">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <x-button wire:click="toggle" primary--}}
{{--                      class="lg:hidden">{{ $more ? __('Czytaj mniej') : __('Czytaj więcej') }}</x-button>--}}
{{--        </div>--}}
        <div class="text-center my-6">
            <h1 class="text-primary-600 text-4xl">
                <b>{{ __('main.products') }}</b>
            </h1>
        </div>
        <div class="max-w-screen-lg mx-auto mb-6">
            <livewire:product.categories mode="elements"/>
        </div>
    </section>
</div>
