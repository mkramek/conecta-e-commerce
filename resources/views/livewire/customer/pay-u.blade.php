<div class="max-w-screen-lg mx-auto">
    <h1 class="text-4xl text-primary-600">{{ __('Dziękujemy za dokonanie płatności!') }}</h1>
    <p class="max-w-screen-md py-6 text-xl">{{ __('Na Twój adres email zostało wysłane potwierdzenie. Zamówienie zostało przekazane do realizacji. O następnych krokach poinformujemy Cię mailem.') }}</p>
    <div>
        <x-button primary outline href='{{ route("profile.$lang") }}' label="{{ __('Moje zamówienia') }}" />
        <x-button primary fill href='{{ route("home.$lang") }}' label="{{ __('Strona główna') }}" />
    </div>
</div>
