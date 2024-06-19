@extends('layouts.mail')

@section('title', __('Zostało utworzone zamówienie'))

@section('body')
    @use(App\Models\ProductVariant, 'ProductVariant')
    <div>
        <p class="text-xl">{{ __('Witaj, :first_name :last_name!', ['first_name' => $customer->first_name, 'last_name' => $customer->last_name]) }}</p>
        <p>{{ __('Zostało utworzone zamówienie.') }}</p>
        <p class="mt-2">{{ __('Szczegóły') }}:</p>
        <div
            class="flex flex-col flex-nowrap gap-2 justify-start items-stretch">
            @foreach($order->items as $item)
                @php
                    $name = "name_{$lang}";
                    $variant = ProductVariant::find($item->product_variant_id)
                @endphp
                <div
                    class="rounded border px-6 py-3 max-w-screen-md flex flex-row gap-4 justify-between">
                    <div>
                        <p class="text-xl font-bold">
                            {{ $variant->product->$name }}
                        </p>
                        <p class="">{{ __('kolor') }}: {{ $variant->color }}</p>
                        <p class="">
                            {{ __('rozmiar') }}: {{ $variant->size }}
                        </p>
                    </div>
                    <div class="flex justify-center items-center">
                        <p>{{ __('Ilość') }}: {{ $item->quantity }}</p>
                    </div>
                    <div class="flex flex-col items-end justify-center">
                        <p class="{{ $variant->brutto_discount_price ? 'line-through text-red-700' : 'font-bold' }}">
                            <span>{{ number_format($item->quantity * $variant->brutto_price, 2) }}</span>
                            <span>PLN</span>
                        </p>
                        @if($variant->brutto_discount_price)
                            <p>
                                <span>{{ number_format($item->quantity * $variant->brutto_discount_price, 2) }}</span>
                                <span>PLN</span>
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
            <div
                class="rounded border px-6 py-3 max-w-screen-md flex flex-row gap-4 justify-between">
                <div>
                    @php
                        $courier = \App\Models\Courier::find($order->courier_id);
                    @endphp
                    <p class="font-bold">
                        {{ __('Kurier') }}: {{ $courier->name }}
                    </p>
                </div>
                <div>
                    <p>
                        {{ number_format($courier->fee, 2) }} PLN
                    </p>
                </div>
            </div>
            <div
                class="rounded border px-6 py-3 max-w-screen-md flex flex-row gap-4 justify-between">
                <div>
                    <p class="font-bold">
                        {{ __('Suma') }}
                    </p>
                </div>
                <div>
                    <p>
                        {{ number_format($order->total_amount, 2) }} PLN
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-4 flex gap-2 justify-start items-center">
            <x-button primary href='{{ $order->payment_url }}'>
                {{ __('Link do płatności') }}
            </x-button>
            <x-button href='{{ route("login.$lang") }}'>
                {{ __('Zaloguj się') }}
            </x-button>
            <x-button href='{{ route("home.$lang") }}'>
                {{ __('Strona główna') }}
            </x-button>
        </div>
        <p class="mt-4">{{ __('Pozdrawiamy') }},</p>
        <p>{{ __('Zespół Conecta') }}</p>
    </div>
@endsection

@section('footer')
    <p>{{ $company->name }}</p>
    <p>{{ $company->address_line_1 }}</p>
    @if($company->address_line_2)
        <p>{{ $company->address_line_2 }}</p>
    @endif
    <p>{{ __('NIP') }}: {{ $company->vat_id }}</p>
    <p>{{ __('Telefon') }}:
        +{{ $company->telephone_prefix }}{{ $company->telephone_number }}</p>
    <p>{{ __('Email') }}: {{ $company->email }}</p>
@endsection
