<div class="max-w-screen-lg mx-auto">
    <h1 class="text-4xl text-primary-600">{{ __('Dziękujemy za złożenie zamówienia!') }}</h1>
    <p class="max-w-screen-md py-6 text-xl">{{ __('Na Twój adres email zostało wysłane potwierdzenie.') }}</p>
    <p class="max-w-screen-md py-6 text-xl">{{ __('Wybrana metoda płatności:') }}</p>
    <h3 class="text-xl font-bold py-6 max-w-screen-md">{{ __($order->paymentMethod->name) }}</h3>
    <div class="mt-6">
        <x-button primary outline href='{{ route("profile.$lang") }}'
                  label="{{ __('Moje zamówienia') }}"/>
        <x-button primary fill href='{{ route("home.$lang") }}'
                  label="{{ __('Strona główna') }}"/>
    </div>
</div>
