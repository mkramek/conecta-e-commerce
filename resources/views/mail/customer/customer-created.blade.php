@extends('layouts.mail')

@section('title', __('Utworzono konto użytkownika'))

@section('body')
    <div>
        <p class="text-xl">{{ __('Witaj, :first_name :last_name!', ['first_name' => $customer->first_name, 'last_name' => $customer->last_name]) }}</p>
        <p>{{ __('Twoje konto w portalu Conecta zostało utworzone.') }}</p>
        <div class="mt-4 flex gap-2 justify-start items-center">
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
