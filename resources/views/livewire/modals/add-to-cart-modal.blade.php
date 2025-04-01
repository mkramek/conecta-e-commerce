<form class="p-4" wire:submit.prevent="addToCart">
    <h3 class="text-2xl font-bold mb-4">Wprowadź ilość</h3>
    <x-input type="number" step="{{ $step }}" min="0" wire:model.live='quantity' class="mb-4" />
    <div class="w-full flex justify-between gap-4">
        <x-button type="submit" class="w-full" primary>Dodaj do koszyka</x-button>
        <x-button type="reset" class="w-full" secondary wire:click="$dispatch('closeModal')">Zamknij</x-button>
    </div>
</form>
