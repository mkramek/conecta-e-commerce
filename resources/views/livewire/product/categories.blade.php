<div>
    @php
        $column_name = "name_$lang";
        $column_slug = "slug_$lang";
    @endphp
    @if ($mode === 'list')
        <div class="flex flex-col">
            @foreach ($primary_categories as $primary)
                <livewire:product.expandable-category-item :category="$primary" level="primary" />
            @endforeach
        </div>
    @else
        <div class="flex flex-wrap justify-center items-start gap-4 mt-6">
            @foreach ($primary_categories as $category)
                <x-button :href='route("products.$lang", ["category_primary" => $category->$column_slug])' :key="$category->id"
                    class="shadow-lg h-52 aspect-square bg-primary-500 hover:border-primary-500 rounded-full text-white hover:text-primary-600 font-bold text-center text-xl break-words p-4 flex flex-col justify-center items-center gap-2"
                >
                    @if ($category->icon)
                        <img
                            src="{{ $category->icon }}"
                            width="100"
                            height="100"
                            alt="Obraz kategorii {{ $category->$column_name }}"
                        />
                    @endif
                    <span class="{{ strlen($category->$column_name) > 20 ? 'text-sm' : '' }}">{{ $category->$column_name }}</span>
                </x-button>
            @endforeach
        </div>
    @endif
</div>
