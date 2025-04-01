@section('title', 'Sign in to your account')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            {{ __('Zaloguj się') }}
        </h2>
        @if (Route::has('register'))
            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                {{ __('Albo') }}
                <a href="{{ route("register.$lang") }}"
                   class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    {{ __('utwórz nowe konto') }}
                </a>
            </p>
        @endif
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="authenticate">
                <div>
                    <label for="email"
                           class="block text-sm font-medium text-gray-700 leading-5">
                        {{ __('Adres email') }}
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-input wire:model.lazy="email" id="email" name="email"
                                 type="email" required autofocus
                                 class="@error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"/>
                    </div>

                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password"
                           class="block text-sm font-medium text-gray-700 leading-5">
                        {{ __('Hasło') }}
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-input wire:model.lazy="password" id="password"
                                 type="password" required
                                 class="@error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"/>
                    </div>

                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <x-checkbox wire:model.lazy="remember" id="remember"
                                    type="checkbox"
                                    class="form-checkbox w-4 h-4 text-primary-600 transition duration-150 ease-in-out"/>
                        <label for="remember"
                               class="block ml-2 text-sm text-gray-900 leading-5">
                            {{ __('Zapamiętaj mnie') }}
                        </label>
                    </div>

                    <div class="text-sm leading-5">
                        <a href="{{ route("password.request.$lang") }}"
                           class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            {{ __('Zapomniane hasło?') }}
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <x-button type="submit" class="w-full">
                            {{ __('Zaloguj') }}
                        </x-button>
                    </span>
                    <span class="block w-full rounded-md shadow-sm mt-4">
                        <x-button outline type="button" href='{{ route("register.$lang") }}' class="w-full">
                            {{ __('Utwórz konto') }}
                        </x-button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
