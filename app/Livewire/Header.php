<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\SeoConfiguration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Header extends Component
{
    public $lang;

    public $route;

    public $languages;

    public array $urls = [];

    public $menu = false;

    public $search = false;

    public ?int $cart_count = null;

    public ?string $query = "";

    public Collection $searchResults;

    public string $meta_title = "";

    public string $meta_desc = "";

    public string $meta_author = "";

    public string $meta_keywords = "";

    public function mount(): void
    {
        $seo = SeoConfiguration::where('lang', app()->getLocale())->first();
        $this->meta_title = $seo->meta_title;
        $this->meta_desc = $seo->meta_description_content;
        $this->meta_author = $seo->meta_author;
        $this->meta_keywords = $seo->meta_keywords;
        $this->searchResults = new Collection();
        $this->route = json_encode(request()->segments());
        $this->lang = app()->getLocale();
        $languages = config('lang.labels');
        $languageMap = [];
        foreach ($languages as $key => $label) {
            $languageMap[] = ['name' => $label, 'id' => $key];
        }
        $this->languages = &$languageMap;
        foreach (config('lang.available_languages') as $lang) {
            $this->urls[$lang] = $this->getCurrentUrlForLang($lang);
        }
    }

    public function getCurrentUrlForLang($lang): string
    {
        $route = json_decode($this->route);
        $route[0] = $lang;
        $path = implode('/', $route);

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

    public function toggleSearch()
    {
        $this->search = !$this->search;
    }

    public function updatedQuery($val)
    {
        if (strlen($val) > 0) {
            $query = strtolower($val);
            $this->searchResults = Product::with('images')->whereRaw("LOWER(name_pl) LIKE \"%{$query}%\"")->orWhereRaw("LOWER(name_en) LIKE \"%{$query}%\"")->get();
        } else {
            $this->searchResults = new Collection([]);
        }
    }
}
