<div>
    @php
        $column_name = "name_$lang";
        $column_slug = "slug_$lang";
    @endphp
    @if($mode === "list")
        <div class="flex flex-col">
            @foreach($primary_categories as $primary)
                <livewire:product.expandable-category-item :category="$primary" level="primary" />
            @endforeach
        </div>
    @else
        <div class="flex flex-wrap justify-center items-start gap-4 mt-6">
            @foreach($primary_categories as $category)
                <x-button
                    :href='route("products.$lang", ["category_primary" => $category->$column_slug])'
                    :key="$category->id"
                    class="shadow-lg h-52 aspect-square bg-primary-500 hover:border-primary-500 rounded-full text-white hover:text-primary-600 font-bold text-center text-xl break-words p-4">
                    {{ $category->$column_name }}
                </x-button>
            @endforeach
        </div>
    @endif
</div>
