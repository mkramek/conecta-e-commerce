<div class="max-w-screen-lg mx-auto">
    <h1 class="text-4xl">Posty</h1>
    <div class="flex flex-col justify-start items-stretch mt-6">
        @foreach($posts as $post)
            <div class="border-y py-4">
                <div class="mb-4 pb-4 flex justify-between items-center border-dashed border-b">
                    <h2 class="text-2xl">{{ $post->title }}</h2>
                    <div class="text-right">
                        <p>
                            <span>Autor:</span>
                            <span class="font-bold">{{ $post->author }}</span>
                        </p>
                        <p>
                            <span>Opublikowano:</span>
                            <span class="font-bold">{{ $post->published_at }}</span>
                        </p>
                    </div>
                </div>
                <div>{!! $post->content !!}</div>
            </div>
        @endforeach
    </div>
</div>
