<?php

namespace App\Livewire\Shared;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ImageSlider extends Component
{
    public int $currentIndex = -1;
    public string $current;
    public string $productName;
    public Collection $images;
    public bool $fade = false;

    public function mount(): void
    {
        if ($this->images->isNotEmpty()) {
            $this->currentIndex = 0;
        }
    }

    public function next(): void
    {
        $this->fade = true;
        if ($this->images->isEmpty()) {
            return;
        } else if ($this->currentIndex === $this->images->count() - 1) {
            $this->currentIndex = 0;
        } else {
            $this->currentIndex++;
        }
    }

    public function prev(): void
    {
        $this->fade = true;
        if ($this->images->isEmpty()) {
            return;
        } else if ($this->currentIndex === 0) {
            $this->currentIndex = $this->images->count() - 1;
        } else {
            $this->currentIndex--;
        }
    }

    public function image(): string
    {
        if ($this->images->isEmpty()) {
            return "https://via.placeholder.com/640x480";
        } else {
            return $this->images[$this->currentIndex]->url;
        }
    }

    public function render(): View
    {
        return view('livewire.shared.image-slider');
    }
}
