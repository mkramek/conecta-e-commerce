<?php

namespace App\Livewire\Product;

use App\Models\Cart;
use App\Models\PriceHistory;
use App\Models\Product;
use App\Models\ProductMetaData;
use App\Models\ProductVariant;
use Carbon\Carbon;
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

    #[Url]
    public $variant;
    public ProductVariant|null $selected = null;
    public Product $product;
    public ProductMetaData $meta;
    public $lang;
    public $quantity = 1;
    public $max_in_stock;
    public mixed $variants;
    public $last_price;

    public function mount($id, $slug): void
    {
        $this->lang = app()->getLocale();
        $this->product = Product::find($id);
        $this->variants = ProductVariant::where('product_id', $this->product->id)
            ->orderBy('size')
            ->get();
        $this->meta = ProductMetaData::where(['product_id' => $this->product->id])->first();
    }

    public function render(): View
    {
        if (intval($this->variant) > 0) {
            $this->selected = $this->product->variants->find($this->variant);
        } else {
            $this->selected = $this->product->variants->first();
        }
        $last_price = PriceHistory::where(['product_variant_id' => $this->selected->id])
            ->where('created_at', '<', Carbon::now()->toISOString())
            ->orderBy('created_at', 'desc')
            ->orderBy('price_gross')->first();
        $this->last_price = $last_price->price_gross < $this->selected->brutto_price ? $last_price->price_gross : $this->selected->brutto_price;
        $this->max_in_stock = $this->selected->quantity;
        return view('livewire.product.single');
    }

    public function send(): void
    {
        try {
            Cart::upsert([
                [
                    'variant_id' => $this->variant,
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

    public function changeVariant($variantId): void
    {
        $this->variant = $variantId;
        $this->selected = $this->product->variants->find($variantId);
    }

    public function updatedVariant($param): void
    {
        Log::info("variant got updated to $param");
    }
}
