<div class="mx-auto max-w-screen-lg mt-8">
    @if ($terms)
        <h1 class="text-3xl font-bold">Zasady i Polityki</h1>
    @else
        <h1 class="text-3xl font-bold">Regulaminy</h1>
    @endif
    <div class="flex gap-4 flex-wrap mt-4">
        @foreach ($regulations as $term)
            <x-button primary xl target="_blank" href="{{ $term->url }}">{{ $term->name }}</x-button>
        @endforeach
    </div>
</div>
