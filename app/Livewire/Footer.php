<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public $footer;
    public $lang;

    public function mount()
    {
        $this->lang = app()->getLocale();
        $this->footer = \App\Models\Footer::first();
    }

    public function render()
    {
        return view('livewire.footer');
    }
}
