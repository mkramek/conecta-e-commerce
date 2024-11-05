<?php

namespace App\Livewire\Modals;

use App\Models\Cart;
use App\Models\ProductVariant;
use LivewireUI\Modal\ModalComponent;

class AddToCartModal extends ModalComponent
{
    public ProductVariant $variant;

    public int $quantity = 0;

    public int $step = 1;

    public ?Cart $saved = null;

    public function mount(): void
    {
        $this->step = $this->variant->product->step;
        $this->saved = Cart::where([
            'customer_id' => auth()->id(),
            'variant_id' => $this->variant->id,
        ])->first();
    }

    public function render()
    {
        return view('livewire.modals.add-to-cart-modal');
    }

    public function addToCart()
    {
        if (!is_null($this->saved)) {
            $this->saved->update(['quantity' => $this->saved->quantity + $this->quantity]);
        } else {
            Cart::create([
                'customer_id' => auth()->id(),
                'variant_id' => $this->variant->id,
                'product_id' => $this->variant->product->id,
                'quantity' => $this->quantity,
            ]);
        }
        $this->dispatch('cart');
        $this->closeModal();
    }
}
