<?php

namespace App\Livewire\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Error;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use WireUi\Traits\Actions;

class Single extends Component
{
    use Actions;

    public $variant;
    public Product $product;
    public $lang;
    public $quantity = 1;
    public $max_in_stock;
    public $variants;

    public function mount($id, $slug): void
    {
        $this->product = Product::find($id);
        $this->variants = ProductVariant::where('product_id', $this->product->id)->get();
        $this->lang = app()->getLocale();
    }

    public function render($variant = null): View
    {
        if ($variant > 0) {
            $this->variant = $this->product->variants->find($variant);
        } else {
            $this->variant = $this->product->variants->first();
        }
        $this->max_in_stock = $this->variant->quantity;
        return view('livewire.product.single');
    }

    public function send(): void
    {
        try {
            Cart::upsert([
                [
                    'variant_id' => $this->variant->id,
                    'product_id' => $this->product->id,
                    'customer_id' => auth()->id() ?? session()->getId(),
                    'quantity' => $this->quantity,
                ]
            ], uniqueBy: ['customer_id', 'variant_id', 'product_id'], update: ['quantity']);
            $this->notification()->success(
                title: __("Dodano do koszyka"),
                description: __("Produkt został dodany do koszyka"),
            );
        } catch (Error $err) {
            Log::error($err);
            $this->notification()->error(
                title: __("Błąd"),
                description: __("Błąd podczas dodawania produktu do koszyka"),
            );
        }

    }

    public function variantRoute($variant_id): string
    {
        $slug = "slug_{$this->lang}";
        return route("product.{$this->lang}", ["variant" => $variant_id, "id" => $this->product->id, "slug" => $this->product->$slug]);
    }

    public function back(): RedirectResponse
    {
        return redirect()->back();
    }
}
