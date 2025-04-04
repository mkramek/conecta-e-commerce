<?php

namespace App\Livewire\Product;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Favorite;
use App\Models\PriceHistory;
use App\Models\Product;
use App\Models\ProductMetaData;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\SizeGroup;
use Carbon\Carbon;
use Error;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Single extends Component
{
    use WireUiActions;

    #[Url]
    public $variant;

    public ?ProductVariant $selected = null;

    public Product $product;

    public ProductMetaData $meta;

    public $lang;

    public $quantity = 1;

    public $max_in_stock;

    public mixed $variants;

    public Collection $availableColors;

    public Collection $availableSizes;

    public $color_id;

    public $size_id;

    public $last_price;

    public bool $favorite;

    public bool $will_customize = false;

    public Collection $similar;

    public Collection $images;

    public $main_image;

    public function mount($id, $slug): void
    {
        $this->lang = app()->getLocale();
        $this->product = Product::find($id);
        $this->variants = ProductVariant::where('product_id', $this->product->id)
            ->orderBy('size')
            ->get();
        $this->availableColors = Color::whereIn('name', ProductVariant::where('product_id', $this->product->id)->pluck('color'))->get();
        $this->availableSizes = $this->getSizesForProduct($this->product);
        $this->meta = ProductMetaData::where(['product_id' => $this->product->id])->first();
        $this->similar = Product::with('firstLevelCategories', 'secondLevelCategories', 'thirdLevelCategories')
            ->whereNotNull("slug_{$this->lang}")
            ->withCount('variants')
            ->having('variants_count', '>', 0)
            ->whereHas('firstLevelCategories')
            ->whereHas('secondLevelCategories', null, '>=', 0)
            ->whereHas('thirdLevelCategories', null, '>=', 0)
            ->limit(8)
            ->get();

        if (intval($this->variant) > 0) {
            $this->selected = $this->product->variants->find($this->variant);
        } else {
            $this->selected = $this->product->variants->first();
        }
        $this->color_id = Color::where('name', $this->selected->color)->first()->name;
        $this->size_id = Size::where('size_value', $this->selected->size)->first()->size_value;
        $last_price = PriceHistory::where(['product_variant_id' => $this->selected->id])
            ->where('created_at', '<', Carbon::now()->toISOString())
            ->orderBy('created_at', 'desc')
            ->orderBy('price_gross')->first();
        $this->last_price = $last_price->price_gross < $this->selected->brutto_price ? $last_price->price_gross : $this->selected->brutto_price;
        $this->max_in_stock = $this->selected->quantity;
        $this->favorite = Favorite::where([
            'customer_id' => auth()->id(),
            'product_variant_id' => $this->selected->id,
        ])->exists();

        if ($this->product->images()->whereNotNull('color_id')->count() > 0) {
            $this->images = $this->product->images()->where('color_id', Color::where('name', $this->color_id)->first()->id)->orderBy('display_position', 'asc')->get();
        } else {
            $this->images = $this->product->images()->orderBy('display_position', 'asc')->get();
        }
    }

    public function getSizesForProduct(Product $product)
    {
        $variantsSizes = $this->product->variants()->pluck('size');
        $group = null;
        $thirds = $product->thirdLevelCategories;
        $seconds = $product->secondLevelCategories;
        $firsts = $product->secondLevelCategories;
        if ($thirds->count() > 0 && $group === null) {
            $group = $thirds[0]->sizeGroup;
        } else if ($seconds->count() > 0 && $group === null) {
            $group = $seconds[0]->sizeGroup;
        } else if ($firsts->count() > 0 && $group === null) {
            $group = $firsts[0]->sizeGroup;
        }

        if ($group !== null) {
            return $group->sizes()->whereIn('size_value', $variantsSizes)->get();
        }

        $groups = SizeGroup::whereHas('sizes', fn ($q) => $q->whereIn('size_value', $variantsSizes))->get();

        $group = $groups->filter(fn ($g) => $g->sizes->count() >= count($variantsSizes))[0];

        return $group->sizes()->whereIn('size_value', $variantsSizes)->get();
    }

    public function render(): View
    {
        return view('livewire.product.single');
    }

    public function addToCart(): void
    {
        if ($this->quantity === 0) {
            $this->notification()->warning(
                title: __('Błąd'),
                description: __('Wybrano zbyt niską ilość przedmiotu'),
            );
        } else {
            try {
                Cart::upsert([
                    [
                        'variant_id' => $this->variant ?? $this->product->variants->first()->id,
                        'product_id' => $this->product->id,
                        'customer_id' => auth()->id() ?? session()->getId(),
                        'quantity' => $this->quantity,
                        'is_customizable' => $this->will_customize,
                    ],
                ], uniqueBy: ['customer_id', 'variant_id', 'product_id'], update: ['quantity', 'is_customizable']);
                $this->notification()->success(
                    title: __('Dodano do koszyka'),
                    description: __('Produkt został dodany do koszyka'),
                );
            } catch (Error $err) {
                Log::error($err);
                $this->notification()->error(
                    title: __('Błąd'),
                    description: __('Błąd podczas dodawania produktu do koszyka'),
                );
            }
        }
    }

    public function variantRoute($variant_id): string
    {
        $slug = "slug_{$this->lang}";

        return route("product.{$this->lang}", ['variant' => $variant_id, 'id' => $this->product->id, 'slug' => $this->product->$slug]);
    }

    public function back(): RedirectResponse
    {
        return redirect()->back();
    }

    public function updatedVariant($variantId)
    {
        return redirect()->to($this->variantRoute($variantId));
    }

    public function getProduct($array): Product
    {
        return Product::find($array['id']);
    }

    public function toggleFavorite(): void
    {
        $favoriteQuery = Favorite::where([
            'customer_id' => auth()->id(),
            'product_variant_id' => $this->variant,
        ])->first();

        if (!is_null($favoriteQuery)) {
            $favoriteQuery->delete();
            $this->favorite = false;
        } else {
            Favorite::create([
                'customer_id' => auth()->id(),
                'product_variant_id' => $this->variant,
            ]);
            $this->favorite = true;
        }
    }

    public function handleVariantChange()
    {
        if ($this->color_id && $this->size_id) {
            $variant = ProductVariant::where([
                'product_id' => $this->product->id,
                'color' => $this->color_id,
                'size' => $this->size_id,
            ])->first();

            if ($variant) {
                return $this->updatedVariant($variant->id);
            }
        }
        return $this->updatedVariant($this->variant);
    }

    public function updatedColorId()
    {
        return $this->handleVariantChange();
    }

    public function updatedSizeId()
    {
        return $this->handleVariantChange();
    }
}
