<div class="max-w-screen-lg mx-auto">
    <h1 class="text-4xl text-primary-600">{{ __('Dziękujemy za złożenie zamówienia!') }}</h1>
    <p class="max-w-screen-md py-6 text-xl">
        {{ __('Na Twój adres email zostało wysłane potwierdzenie. Poniżej są dane do przelewu.') }}</p>
    <table class="max-w-screen-md py-6 text-lg border">
        <tbody>
            <tr class="border">
                <td class="border px-2 py-1 font-bold">{{ __('Nazwa banku') }}</td>
                <td class="border px-2 py-1">{{ $data->bank_name }}</td>
            </tr>
            <tr class="border">
                <td class="border px-2 py-1 font-bold">{{ __('BIC/SWIFT') }}</td>
                <td class="border px-2 py-1">{{ $data->swift }}</td>
            </tr>
            <tr class="border">
                <td class="border px-2 py-1 font-bold">{{ __('Numer konta') }}</td>
                <td class="border px-2 py-1">{{ $data->bank_account_number }}</td>
            </tr>
            <tr class="border">
                <td class="border px-2 py-1 font-bold">{{ __('Tytuł przelewu') }}</td>
                <td class="border px-2 py-1">{{ $order->id }}</td>
            </tr>
        </tbody>
    </table>
    <div class="mt-6">
        @if (Auth::check())
            <x-button primary outline href='{{ route("profile.$lang") }}' label="{{ __('Moje zamówienia') }}" />
        @endif
        <x-button primary fill href='{{ route("home.$lang") }}' label="{{ __('Strona główna') }}" />
    </div>
</div>
