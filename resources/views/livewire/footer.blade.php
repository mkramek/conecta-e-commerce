<footer
    class="bg-zinc-600 text-white flex flex-col items-stretch justify-evenly gap-4 pt-8 pb-6 mt-8 lg:h-72 px-8">
    <div class="flex mx-auto gap-4 flex-col lg:flex-row">
        <div class="pb-5 text-center my-auto">
            <div class="text-center">
                <img src="{{ asset('img/svg/Con_krzywe.svg') }}" alt="">
            </div>
        </div>
        <div class="text-left">
            @if ($footer)
                <p>
                    <x-icon name="location-marker" class="h-4 inline"/>
                    {{ $footer->company_name }}<br>
                    {{ __('main.st') }}
                    <b>{{ $footer->street }} {{ $footer->house_number }} {{ $footer->apartment_number }}</b>
                    <br>
                    {{ $footer->postal_code }} <b>{{ $footer->city }}</b>
                </p>
                <p>
                    <x-icon name="phone" class="h-4 inline"/>
                    <b>{{ $footer->telephone_one }}</b><br>
                    @if ($footer->telephone_two)
                        <x-icon name="phone" class="h-4 inline"/>
                        <b>{{ $footer->telephone_two }}</b><br>
                    @endif
                </p>
                <p>
                    @if ($footer->fax)
                        fax. <b>{{ $footer->fax }}</b> <i
                            class="fa-solid fa-fax"></i><br>
                    @endif
                        <x-icon name="mail" class="h-4 inline"/>
                        <b>{{ $footer->email }} <i
                            class="fa-solid fa-envelope"></i></b>
                </p>
            @else
                <p>Brak danych do wyświetlenia w stopce.</p>
            @endif
        </div>
    </div>

    <nav class="list-none flex mt-8 lg:mt-0 mx-auto max-w-screen-lg gap-4 flex-wrap lg:flex-nowrap lg:flex-row items-stretch lg:items-center">
        <a href="{{ route('terms.' . $lang, 1) }}">
            <li>{{__('main.privacy_policy')}}</li>
        </a>
        <a href="{{ route('terms.' . $lang) }}">
            <li>{{__('main.regulations')}}</li>
        </a>
        <a href="{{ route('contact.' . $lang) }}">
            <li>{{__('main.contact')}}</li>
        </a>
        <a href="{{ route('home.' . $lang) }}">
            <li>{{__('main.about_us')}}</li>
        </a>
    </nav>
</footer>
