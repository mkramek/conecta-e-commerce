<div>
    @if(!auth()->id())
        <div class="flex">
            <div
                class="border rounded-xl max-w-screen-sm w-full p-4 mx-auto flex items-center justify-center gap-4 flex-col">
                <p>Masz u nas konto?</p>
                <x-button class="w-full" primary
                          href='{{ route("login.$lang", ["from" => request()->path()]) }}'>
                    Zaloguj się
                </x-button>
            </div>
        </div>
    @endif
    <div class="mt-4 max-w-screen-sm border mx-auto p-4 rounded-xl">
        <div class="flex">
            <p class="basis-1/4 text-center font-bold">{{ __('Nazwa produktu') }}</p>
            <p class="basis-1/4 text-center font-bold">{{ __('Ilość') }}</p>
            <p class="basis-1/4 text-center font-bold">{{ __('Cena podstawowa') }}</p>
            <p class="basis-1/4 text-center font-bold">{{ __('Cena promocyjna') }}</p>
        </div>
        @foreach($items as $item)
            <div class="flex">
                <p class="basis-1/4 text-center">{{ $item->variant->$nameColumn }}</p>
                <p class="basis-1/4 text-center">{{ $item->quantity }}</p>
                <p class="basis-1/4 text-center">
                    <span>{{ number_format($item->variant->brutto_price * $item->quantity, 2) }}</span>
                    <span>PLN</span>
                </p>
                <p class="basis-1/4 text-center">
                    @if($item->variant->brutto_discount_price)
                        <span>{{ number_format($item->variant->brutto_discount_price * $item->quantity, 2) }}</span>
                        <span>PLN</span>
                    @else
                        <span>-</span>
                    @endif
                </p>
            </div>
        @endforeach
        <div class="flex mt-4">
            <p class="basis-1/2 text-center"></p>
            <p class="basis-1/4 text-center font-bold">{{ __('Dostawa') }}</p>
            <p class="basis-1/4 text-center uppercase font-bold">{{ $delivery_fee ?? '-' }}
                PLN</p>
        </div>
        <div class="flex mt-4">
            <p class="basis-1/2 text-center"></p>
            <p class="basis-1/4 text-center uppercase font-bold">Suma</p>
            <p class="basis-1/4 text-center uppercase font-bold">{{ $this->getTotal() }}
                PLN</p>
        </div>
    </div>
    <form wire:submit.prevent="handleOrder"
          class="mt-4 max-w-screen-sm border mx-auto p-4 rounded-xl">
        <h2 class="text-xl font-bold">Dane adresowe do zamówienia</h2>
        <div>
            <div class="flex w-full items-center justify-start gap-4 mt-4">
                <x-radio required id="address_no_invoice" label="Osoba fizyczna"
                         wire:model.live="address_form.document"
                         value="no_invoice"/>
                <x-radio required id="address_invoice" label="Firma"
                         wire:model.live="address_form.document"
                         value="invoice"/>
            </div>
            @if($address_form['document'] === "invoice")
                <div class="flex w-full items-center justify-center gap-4 mt-4">
                    <div class="w-full">
                        <x-input class="w-full" label="NIP"
                                 wire:model="address_form.nip"></x-input>
                    </div>
                    <div class="w-full">
                        <x-input class="w-full" label="Nazwa firmy"
                                 wire:model="address_form.company_name"></x-input>
                    </div>
                </div>
            @endif
            <div class="flex w-full items-center justify-center gap-4 mt-4">
                <div class="w-full">
                    <x-input required class="w-full" label="Imię"
                             wire:model="address_form.first_name"></x-input>
                </div>
                <div class="w-full">
                    <x-input required class="w-full" label="Nazwisko"
                             wire:model="address_form.last_name"></x-input>
                </div>
            </div>
            <div class="flex w-full items-center justify-center gap-4 mt-4">
                <div class="basis-1/2">
                    <x-input required type="email" class="w-full"
                             label="Adres e-mail"
                             wire:model="address_form.email"></x-input>
                </div>
                <div class="basis-1/6">
                    <x-input prefix="+" label="Prefiks"
                             wire:model="address_form.telephone_prefix"></x-input>
                </div>
                <div class="basis-2/6">
                    <x-input class="" label="Numer telefonu"
                             wire:model="address_form.telephone_number"></x-input>
                </div>
            </div>
            <div class="flex w-full items-center justify-center gap-4 mt-4">
                <div class="basis-3/5">
                    <x-input required class="w-full" label="Ulica"
                             wire:model="address_form.street"></x-input>
                </div>
                <div class="basis-1/5">
                    <x-input required class="w-full" label="Nr domu"
                             wire:model="address_form.house_number"></x-input>
                </div>
                <div class="basis-1/5">
                    <x-input class="w-full" label="Nr mieszkania"
                             wire:model="address_form.apartment_number"></x-input>
                </div>
            </div>
            <div class="flex w-full items-center justify-center gap-4 mt-4">
                <div class="basis-2/12">
                    <x-input required class="w-full" label="Kod pocztowy"
                             wire:model="address_form.postal_code"></x-input>
                </div>
                <div class="basis-4/12">
                    <x-input required class="w-full" label="Miasto"
                             wire:model="address_form.city"></x-input>
                </div>
                <div class="basis-3/12">
                    <x-input required class="w-full" label="Województwo"
                             wire:model="address_form.province"></x-input>
                </div>
                <div class="basis-3/12">
                    <x-input required class="w-full" label="Kraj"
                             wire:model="address_form.country"></x-input>
                </div>
            </div>
        </div>
        <h2 class="text-xl font-bold mt-8">Dane do wysyłki</h2>
        <div class="mt-4">
            <x-checkbox wire:model.live="delivery_form.duplicate"
                        label="Takie same, jak do zamówienia"/>
            @if(!$delivery_form['duplicate'])
                <div class="flex w-full items-center justify-start gap-4 mt-4">
                    <x-radio id="delivery_no_invoice" label="Osoba fizyczna"
                             wire:model.live="delivery_form.document"
                             value="no_invoice"/>
                    <x-radio id="delivery_invoice" label="Firma"
                             wire:model.live="delivery_form.document"
                             value="invoice"/>
                </div>
                @if($delivery_form['document'] === "invoice")
                    <div
                        class="flex w-full items-center justify-center gap-4 mt-4">
                        <div class="w-full">
                            <x-input class="w-full" label="NIP"
                                     wire:model="delivery_form.nip"></x-input>
                        </div>
                        <div class="w-full">
                            <x-input class="w-full" label="Nazwa firmy"
                                     wire:model="delivery_form.company_name"></x-input>
                        </div>
                    </div>
                @endif
                <div class="flex w-full items-center justify-center gap-4 mt-4">
                    <div class="w-full">
                        <x-input class="w-full" label="Imię"
                                 wire:model="delivery_form.first_name"></x-input>
                    </div>
                    <div class="w-full">
                        <x-input class="w-full" label="Nazwisko"
                                 wire:model="delivery_form.last_name"></x-input>
                    </div>
                </div>
                <div class="flex w-full items-center justify-center gap-4 mt-4">
                    <div class="w-full">
                        <x-input type="email" class="w-full"
                                 label="Adres e-mail"
                                 wire:model="delivery_form.email"></x-input>
                    </div>
                    <div class="basis-1/6">
                        <x-input prefix="+" label="Prefiks"
                                 wire:model="delivery_form.telephone_prefix"></x-input>
                    </div>
                    <div class="basis-2/6">
                        <x-input class="" label="Numer telefonu"
                                 wire:model="delivery_form.telephone_number"></x-input>
                    </div>
                </div>
                <div class="flex w-full items-center justify-center gap-4 mt-4">
                    <div class="basis-3/5">
                        <x-input class="w-full" label="Ulica"
                                 wire:model="delivery_form.street"></x-input>
                    </div>
                    <div class="basis-1/5">
                        <x-input class="w-full" label="Nr domu"
                                 wire:model="delivery_form.house_number"></x-input>
                    </div>
                    <div class="basis-1/5">
                        <x-input class="w-full" label="Nr mieszkania"
                                 wire:model="delivery_form.apartment_number"></x-input>
                    </div>
                </div>
                <div class="flex w-full items-center justify-center gap-4 mt-4">
                    <div class="basis-2/12">
                        <x-input class="w-full" label="Kod pocztowy"
                                 wire:model="delivery_form.postal_code"></x-input>
                    </div>
                    <div class="basis-4/12">
                        <x-input class="w-full" label="Miasto"
                                 wire:model="delivery_form.city"></x-input>
                    </div>
                    <div class="basis-3/12">
                        <x-input class="w-full" label="Województwo"
                                 wire:model="delivery_form.province"></x-input>
                    </div>
                    <div class="basis-3/12">
                        <x-input class="w-full" label="Kraj"
                                 wire:model="delivery_form.country"></x-input>
                    </div>
                </div>
            @endif
        </div>
        <h2 class="text-xl font-bold mt-8">Metody dostawy</h2>
        <div class="flex flex-col gap-4 mt-4">
            @foreach($couriers as $crr)
                <label for="courier_{{ $crr->id }}"
                       class="border rounded-lg flex justify-start items-center p-4 gap-4 hover:cursor-pointer">
                    <x-radio required lg id="courier_{{ $crr->id }}"
                             wire:model.live="courier"
                             value="{{ $crr->id }}"/>
                    <img src="{{ $crr->img_url }}"
                         alt="{{ $crr->name }}" class="h-12"/>
                    <p>{{ $crr->name }} (+{{ $crr->fee }} PLN)</p>
                </label>
            @endforeach
        </div>
        <h2 class="text-xl font-bold mt-8">Metody płatności</h2>
        <div class="flex flex-col gap-4 mt-4">
            @foreach($payment_methods as $method)
                <label for="method_{{ $method->id }}"
                       class="border rounded-lg flex justify-start items-center p-4 gap-4 hover:cursor-pointer">
                    <x-radio required lg id="method_{{ $method->id }}"
                             wire:model.live="payment_method"
                             value="{{ $method->id }}"/>
                    <img src="{{ $method->img_url }}"
                         alt="{{ $method->name }}" class="h-12"/>
                    <p>{{ $method->name }}</p>
                </label>
            @endforeach
        </div>
        <h2 class="text-xl font-bold mt-8">Promocje</h2>
        <div wire:submit.prevent="applyPromoCode"
             class="flex gap-4 mt-4 justify-between items-end">
            <div class="basis-5/6">
                <x-input class="w-full" wire:model.live="discount_code"
                         label="{{ __('Kod promocyjny') }}"/>
            </div>
            <div class="basis-1/6">
                <x-button type="button" wire:click="applyPromoCode" primary
                          label="{{ __('Sprawdź') }}"/>
            </div>
        </div>
        <div class="flex flex-col gap-4 mt-4">
            <x-checkbox
                label="{{ __('Wyrażam zgodę na przetwarzanie moich danych osobowych na rzecz zamówienia') }}"
                id="gdpr"
                wire:model.live="gdpr"
                required
            />
            <label class="text-sm flex gap-2" for="tos_and_pp">
                <x-checkbox
                    id="tos_and_pp"
                    wire:model.live="terms"
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
        </div>
        <x-button type="submit" primary class="mt-8 w-full text-xl">
            <span>{{ __('Złóż zamówienie na kwotę') }}</span>
            <span>{{ number_format($total_amount, 2) }}</span>
            <span>PLN</span>
        </x-button>
    </form>
</div>
