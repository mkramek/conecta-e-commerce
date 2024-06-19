<div>
    @php
        $column_slug = "slug_$lang";
    @endphp
    <div class="flex justify-start items-center uppercase">
        @if($availableSecondaryCategories || $availableTertiaryCategories)
            <x-button wire:click="toggle" flat class="!px-2">
                @if($expanded)
                    <x-icon name="minus" regular class="w-4"/>
                @else
                    <x-icon name="plus" regular class="w-4"/>
                @endif
            </x-button>
        @else
            <div class="w-8 h-8"></div>
        @endif
        <a href='{{ route("products.$lang", $this->getCategories()) }}'>{{ $this->getCategoryName() }}</a>
    </div>
    @if($availableSecondaryCategories && $expanded)
        <div class="pl-8 flex flex-col gap-2">
            @foreach($this->category->secondLevelCategories as $category)
                <livewire:product.expandable-category-item :category="$category"
                                                           level="secondary"/>
            @endforeach
        </div>
    @endif
    @if($availableTertiaryCategories && $expanded)
        <div class="pl-8 flex flex-col gap-2">
            @foreach($this->category->thirdLevelCategories as $category)
                <livewire:product.expandable-category-item :category="$category"
                                                           level="tertiary"/>
            @endforeach
        </div>
    @endif
</div>
