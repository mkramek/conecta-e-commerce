<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\View\View;
use Livewire\Component;

class Header extends Component
{
    public $lang;
    public $route;
    public $languages;
    public array $urls = [];
    public $menu = false;
    public ?int $cart_count = null;

    public function mount(): void
    {
        $this->route = json_encode(request()->segments());
        $this->lang = app()->getLocale();
        $languages = config("lang.labels");
        $languageMap = [];
        foreach ($languages as $key => $label) {
            $languageMap[] = ['name' => $label, 'id' => $key];
        }
        $this->languages = &$languageMap;
        foreach (config("lang.available_languages") as $lang) {
            $this->urls[$lang] = $this->getCurrentUrlForLang($lang);
        }
    }

    public function getCurrentUrlForLang($lang): string
    {
        $route = json_decode($this->route);
        $route[0] = $lang;
        $path = implode("/", $route);
        return "/$path";
    }

    public function render(): View
    {
        if (auth()->check()) {
            $cart_id = auth()->id();
        } else {
            $cart_id = session()->getId();
        }
        $this->cart_count = Cart::where('customer_id', $cart_id)->sum('quantity');
        return view('livewire.header');
    }

    public function toggle(): void
    {
        $this->menu = !$this->menu;
    }
}
