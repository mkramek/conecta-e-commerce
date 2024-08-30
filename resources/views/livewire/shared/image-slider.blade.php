<div>
    <div class="flex flex-row flex-nowrap">
        <div
            class="rounded-l-full border-y border-l w-12 flex justify-center items-center cursor-pointer hover:bg-zinc-200"
            wire:click="prev">
            <x-icon name="chevron-left"/>
        </div>
        <div class="border-y">
            <img src="{{ $this->image() }}" alt="{{ $productName }}"/>
        </div>
        <div
            class="rounded-r-full border-y border-r w-12 flex justify-center items-center cursor-pointer hover:bg-zinc-200"
            wire:click="next">
            <x-icon name="chevron-right"/>
        </div>
    </div>
</div>
