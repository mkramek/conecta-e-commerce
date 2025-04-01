<?php

namespace App\Livewire\Product;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class VariantCard extends Component
{
    use WireUiActions;

    public ProductVariant $variant;

    public Product $product;

    public $lang;

    public int $quantity = 1;

    public bool $favorite;

    public bool $fill;

    public string $url;

    public function mount(): void
    {
        if (!$this->product && $this->variant) {
            $this->product = Product::find($this->variant->product_id);
        } else {
            $this->variant = $this->product->variants->first();
        }
        $this->lang = app()->getLocale();
        $this->favorite = auth()->id() && Favorite::where(['product_variant_id' => $this->variant->id, 'customer_id' => auth()->id()])->exists();
        $slug_column = "slug_{$this->lang}";
        $this->url = route("product.{$this->lang}", [
            'id' => $this->product->id,
            'slug' => $this->product->$slug_column,
            'variant' => $this->variant->id,
        ]);
    }

    public function render(): View
    {
        return view('livewire.product.variant-card');
    }

    public function addToCart(): void
    {
        $customer = auth()->id() ?? session()->getId();
        Cart::create(['customer_id' => $customer, 'product_id' => $this->product->id, 'variant_id' => $this->variant->id, 'quantity' => $this->quantity]);
        $this->notification()->success('Dodano do koszyka', 'Produkt dodano do koszyka!');
    }

    public function toggleFavorite(): void
    {
        $fav = Favorite::where(['product_variant_id' => $this->variant->id, 'customer_id' => auth()->id()]);
        if ($fav->exists()) {
            $fav->forceDelete();
            $this->favorite = false;
        } else {
            Favorite::create(['product_variant_id' => $this->variant->id, 'customer_id' => auth()->id()])->save();
            $this->favorite = true;
        }
    }
}
