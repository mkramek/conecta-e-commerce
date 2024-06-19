<?php

namespace App\Livewire\Public;

use App\Models\FirstLevelCategory;
use Livewire\Component;

class Home extends Component
{
    public $lang;
    public $more = false;

    public function mount()
    {
        $this->lang = app()->getLocale();
    }

    public function render()
    {
        return view('livewire.public.home')->extends('layouts.app');
    }

    public function toggle()
    {
        $this->more = !$this->more;
    }
}
