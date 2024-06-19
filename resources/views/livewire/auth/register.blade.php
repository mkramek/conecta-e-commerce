@section('title', __('Utwórz nowe konto'))

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-12 text-3xl font-extrabold text-center text-gray-900 leading-9">
            {{ __('Utwórz nowe konto') }}
        </h2>

        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
            {{ __('Albo') }}
            <a href="{{ route("login.$lang") }}"
               class="font-medium text-primary-600 hover:text-primary-800 focus:outline-none focus:underline transition ease-in-out duration-150">
                {{ __('zaloguj się na swoje konto') }}
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="register">
                <div class="mt-1">
                    <label for="login"
                           class="block text-sm font-medium text-gray-700 leading-5">
                        {{ __('Login') }}
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-input wire:model="login"
                                 id="login" type="text"
                                 required
                        />
                    </div>
                    @error('login')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <div class="mt-6 rounded-md shadow-sm">
                        <x-input wire:model="first_name" id="first-name"
                                 type="text"
                                 label="Imię"
                                 required autofocus
                                 class="@error('first_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"/>
                    </div>
                    @error('first_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="mt-6 rounded-md shadow-sm">
                        <x-input wire:model="last_name" id="last-name"
                                 type="text"
                                 label="Nazwisko"
                                 required autofocus
                                 class="@error('last_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"/>
                    </div>
                    @error('last_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="email"
                           class="block text-sm font-medium text-gray-700 leading-5">
                        {{ __('Adres e-mail') }}
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-input wire:model="email" id="email" type="email"
                                 required
                                 class="@error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"/>
                    </div>

                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <div class="mt-6 basis-1/6">
                        <label for="telephone_prefix"
                               class="block text-sm font-medium text-gray-700 leading-5">
                            {{ __('Prefiks') }}
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <x-input prefix="+"
                                     wire:model="telephone_prefix"
                                     id="telephone_prefix" type="tel"
                                     required
                                     class="@error('telephone_prefix') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"/>
                        </div>
                        @error('telephone_prefix')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-6 basis-5/6">
                        <label for="telephone_number"
                               class="block text-sm font-medium text-gray-700 leading-5">
                            {{ __('Numer telefonu') }}
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <x-input wire:model="telephone_number"
                                     id="telephone_number" type="tel"
                                     required
                                     class="@error('telephone_number') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"/>
                        </div>
                        @error('telephone_number')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="password"
                           class="block text-sm font-medium text-gray-700 leading-5">
                        {{ __('Hasło') }}
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-input wire:model="password" id="password"
                                 type="password" required
                                 class="@error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"/>
                    </div>

                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password_confirmation"
                           class="block text-sm font-medium text-gray-700 leading-5">
                        {{ __('Powtórz hasło') }}
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-input wire:model="password_confirmation"
                                 id="password_confirmation" type="password"
                                 required
                        />
                    </div>
                </div>

                <div class="flex flex-col gap-4 mt-6">
                    <label class="text-sm flex gap-2" for="rodo_acceptance">
                        <x-checkbox
                            id="rodo_acceptance"
                            wire:model="rodo_acceptance"
                            required
                        />
                        <p>
                            <span>{{ __('Akceptuję') }}</span>
                            <a class="italic underline"
                               href='{{ route("terms.$lang") }}'>{{ __('regulamin') }}</a>
                            <span>{{ __('oraz') }}</span>
                            <a class="italic underline"
                               href='{{ route("privacy.$lang") }}'>{{ __('politykę prywatności') }}</a>
                        </p>
                    </label>
                    <x-checkbox
                        label="{{ __('Wyrażam zgodę na przetwarzanie moich danych osobowych w celach marketingowych na rzecz firmy Conecta sp. z o.o.') }}"
                        id="marketing_agreement"
                        wire:model="marketing_agreement"
                    />
                    <x-checkbox
                        label="{{ __('Chcę zapisać się na newsletter') }}"
                        id="allow_newsletter"
                        wire:model="allow_newsletter"
                    />
                </div>

                <div class="mt-6">
                    <x-button primary full type="submit">
                        {{ __('Utwórz konto') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
