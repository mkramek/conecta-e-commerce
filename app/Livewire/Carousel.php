<?php

namespace App\Livewire;

use App\Models\HeaderImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Carousel extends Component
{
    public Collection $images;

    public function mount(): void
    {
        $this->images = HeaderImage::orderBy('position')->get();
    }

    public function render(): View
    {
        return view('livewire.carousel');
    }
}
