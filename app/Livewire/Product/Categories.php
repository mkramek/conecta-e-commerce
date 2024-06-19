<?php

namespace App\Livewire\Product;

use App\Models\FirstLevelCategory;
use App\Models\SecondLevelCategory;
use App\Models\ThirdLevelCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Categories extends Component
{
    public $lang;
    /** @var "list" | "elements" */
    public $mode = "list";

    public Collection $primary_categories;
    public Collection $secondary_categories;
    public Collection $tertiary_categories;

    public function mount(string $mode = "list"): void
    {
        $this->lang = app()->getLocale();
        $this->mode = $mode;
        $this->primary_categories = FirstLevelCategory::all();
        $this->secondary_categories = SecondLevelCategory::all();
        $this->tertiary_categories = ThirdLevelCategory::all();
    }

    public function render(): View
    {
        return view('livewire.product.categories');
    }
}
