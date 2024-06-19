<div class="mx-auto max-w-screen-md">
    <h1 class="mt-2 text-4xl text-center">{{ __('Zapisz się na newsletter') }}</h1>
    <h2 class="mt-2 text-center">{{ __('...i otrzymaj nowości, promocje oraz informacje o naszych produktach!') }}</h2>
    <form wire:submit="submit" class="mt-4 flex flex-col gap-4">
        <x-input type="email" wire:model.live="email" />
        <x-button color="primary" type="submit" class="w-full">{{ __('Zapisz się') }}</x-button>
    </form>
</div>
