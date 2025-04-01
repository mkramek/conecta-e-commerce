<?php

namespace App\Livewire\Product;

use App\Models\FirstLevelCategory;
use App\Models\Producer;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\SecondLevelCategory;
use App\Models\ThirdLevelCategory;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $lang;
    public $category_column;
    public $producers;
    public $availabilities;
    public $primary = null;
    public $secondary = null;
    public $tertiary = null;

    public $filters = [
        'producer' => '',
        'availability' => null,
        'price_min' => '',
        'price_max' => '',
    ];

    public function mount($category_primary = null, $category_secondary = null, $category_tertiary = null): void
    {
        $this->lang = app()->getLocale();
        $this->producers = Producer::all();
        $this->primary = $category_primary;
        $this->secondary = $category_secondary;
        $this->tertiary = $category_tertiary;
    }

    public function render(): View
    {
        $products = $this->getProducts();
        return view('livewire.product.listing', [
            'products' => $products->paginate(perPage: 12),
        ]);
    }

    public function getProducts()
    {
        $categories = [
            'first' => [],
            'second' => [],
            'third' => [],
        ];
        $result = Product::with('variants')
            ->where('is_active', 1)
            ->whereNotNull("slug_{$this->lang}");
        if ($this->primary) {
            $primary_category = FirstLevelCategory::where("slug_{$this->lang}", $this->primary)->first();
            $categories['first'][] = $primary_category->id;
            if ($this->secondary) {
                $secondary_category = SecondLevelCategory::where([
                    'first_level_category_id' => $primary_category->id,
                    "slug_{$this->lang}" => $this->secondary,
                ])->first();
                $categories['second'][] = $secondary_category->id;
                if ($this->tertiary) {
                    $tertiary_category = ThirdLevelCategory::where([
                        'second_level_category_id' => $secondary_category->id,
                        "slug_{$this->lang}" => $this->tertiary,
                    ])->first();
                    $categories['third'][] = $tertiary_category->id;
                } else {
                    $categories['third'] = ThirdLevelCategory::where('second_level_category_id', $secondary_category->id)->pluck('id');
                }
            } else {
                $categories['second'] = SecondLevelCategory::where('first_level_category_id', $primary_category->id)->pluck('id');
                $categories['third'] = ThirdLevelCategory::whereIn('second_level_category_id', $categories['second'])->pluck('id');
            }
        }

        if ($this->filters['availability'] === 'none') {
            $result = $result->whereHas('variants', fn($query) => $query->where('quantity', '<', 1));
        } else if ($this->filters['availability'] === 'small') {
            $result = $result->whereHas('variants', fn($query) => $query->whereBetween('quantity', [1, 10]));
        } else if ($this->filters['availability'] === 'large') {
            $result = $result->whereHas('variants', fn($query) => $query->where('quantity', '>=', 10));
        }
        if ($this->filters['availability']) {
            $result = $result->whereHas('variants', fn($query) => $query->where('quantity', $this->filters['availability'] === 1 ? ">" : "=", 0));
        }
        if ($this->filters['price_min']) {
            $result = $result->whereHas('variants', fn($query) => $query->where('brutto_price', ">=", $this->filters['price_min']));
        }
        if ($this->filters['price_max']) {
            $result = $result->whereHas('variants', fn($query) => $query->where('brutto_price', "<=", $this->filters['price_max']));
        }
        if ($this->filters['producer']) {
            $result = $result->where('producer', $this->filters['producer']);
        }
        if (!empty($categories['first'])) {
            $products_primary = Product::whereHas('firstLevelCategories', fn($q) => $q->whereIn('id', $categories['first']))->pluck('id')->toArray();
            $products_secondary = Product::whereHas('secondLevelCategories', fn($q) => $q->whereIn('id', $categories['second']))->pluck('id')->toArray();
            $products_tertiary = Product::whereHas('thirdLevelCategories', fn($q) => $q->whereIn('id', $categories['third']))->pluck('id')->toArray();
            $result = $result->whereIn('id', array_merge($products_primary, $products_secondary, $products_tertiary));
        }

        return $result->orderBy('priority', 'desc');
    }
}
