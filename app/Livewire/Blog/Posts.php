<?php

namespace App\Livewire\Blog;

use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class Posts extends Component
{
    public $posts;

    public function mount(): void
    {
        $this->posts = \App\Models\Post::whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.blog.posts');
    }
}
