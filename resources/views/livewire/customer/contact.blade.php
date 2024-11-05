 <div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="max-w-screen-xl mx-auto py-4 flex-wrap justify-start md:justify-evenly px-4">
        <div>
            <div class="text-center p-2">
                <img src="{{ asset('img/svg/Con_krzywe_czarne.svg') }}" alt="">
            </div>
        </div>
        <div class="bg-primary-500 flex flex-col items-stretch justify-evenly gap-4">
            <div class="flex items-center mx-auto gap-4 flex-col lg:flex-row p-4">
                @if ($contact)
                    <div class="flex flex-col gap-3 ">
                        <div class="flex items-center gap-1">
                            <div>
                                <x-icon name="location-marker" class="h-4 inline"/>
                            </div>
                            <div>
                                <p>{{ $contact->company_name }}</p>
                                <p>ul. <b>{{ $contact->street }} {{ $contact->house_number }} {{ $contact->apartment_number }}</b></p>
                                <p>{{ $contact->postal_code }} <b>{{ $contact->city }}</b></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <div>
                                <x-icon name="phone" class="h-4 inline"/>
                            </div>
                            <div>
                                <p>tel. <b>{{ $contact->telephone_one }}</b></p>
                                @if ($contact->telephone_two)
                                    <p>tel. <b>{{ $contact->telephone_two }}</b></p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            <div class="flex-row">
                                @if ($contact->fax)
                                    <x-icon name="printer" class="h-4 my-2"/>
                                @endif
                                <x-icon name="mail" class="h-4 my-2"/>
                            </div>
                            <div>
                                @if ($contact->fax)
                                    <p>fax: {{ $contact->fax }}</p>
                                @endif
                                <p>e-mail: {{ $contact->email }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    Brak danych kontaktowych do wyświetlenia
                @endif
                <div>
                    <div class="p-4">
                        <iframe class="overflow-visible" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2447.1033690233835!2d20.921683749860335!3d52.168814025901426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471933dbd1ffc1c1%3A0xa83741d2f58e9f5f!2sConecta%20Sp.%20z%20o.o.!5e0!3m2!1spl!2spl!4v1725205108749!5m2!1spl!2spl" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <form class="p-4 mt-2">
            <h3 class="font-bold">
                Formularz kontaktowy
            </h3>
            <div class="flex flex-col lg:flex-row items-stretch justify-evenly gap-3 py-2">
                <div class="basis-1/4">
                    <x-input 
                        label="Imie/ Nazwa firmy" 
                        id="contact_name"
                        wire:model.live="contact.name"
                    />
                    <x-input 
                        label="E-mail" 
                        id="contact_email"
                        wire:model.live="contact.email"
                    />
                    <x-input 
                        label="Telefon" 
                        id="contact_phone"
                        wire:model.live="contact.phone"
                    />
                </div>
                <div class="basis-1/2">
                    <x-textarea 
                        label="Wiadomość"
                        id="contact_message"
                        wire:model="message"
                    />
                </div>
                <div class="basis-1/4 py-4">
                    <x-button class="mt-2 w-full bg-primary-500 ">
                        <p class="text-white font-bold">Wyślij</p>
                    </x-button>
                    <x-button class="mt-2 w-full bg-secondary-500 ">
                        <p class="text-black font-bold">Wyczyść</p>
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</div> 

  
