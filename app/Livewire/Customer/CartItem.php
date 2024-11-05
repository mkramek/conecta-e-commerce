<?php

namespace App\Livewire\Customer;

use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class CartItem extends Component
{
    use Actions;

    public \App\Models\Cart $item;
    public $lang;
    public float $subtotal = 0.0;
    public float|null $discount_subtotal = null;

    protected $rules = [
        'item.quantity' => 'required|numeric|min:1'
    ];

    public function mount(\App\Models\Cart $item): void
    {
        $this->item = $item;
        $this->lang = app()->getLocale();
        $this->calculate();
    }

    public function render(): View
    {
        $this->dispatch("new_quantity", [
            'item' => $this->item->id,
            'quantity' => $this->item->quantity,
        ]);
        return view('livewire.customer.cart-item');
    }

    private function calculate(): void
    {
        if ($this->item->quantity < 1) {
            $this->item->quantity = $this->item->variant->product->step;
        }
        if ($this->item->variant->brutto_discount_price) {
            $this->discount_subtotal = $this->item->quantity * $this->item->variant->brutto_discount_price;
        }
        $this->subtotal = $this->item->quantity * $this->item->variant->brutto_price;
    }

    public function updated($param): void
    {
        if ($param === "item.quantity" && $this->item->quantity < 1) {
            $this->item->update(['quantity' => $this->item->product->step]);
            $this->confirm();
        }
    }

    public function confirm(): void
    {
        $this->dialog()->confirm([
            'title' => __('Czy na pewno?'),
            'description' => __('Czy na pewno chcesz usunąć ten produkt z koszyka?'),
            'accept' => [
                'label' => __('Tak'),
                'method' => 'remove',
            ],
            'reject' => [
                'label' => __('Nie'),
            ]
        ]);
    }

    public function remove(): void
    {
        $removed = \App\Models\Cart::find($this->item->id)->delete();
        if ($removed) {
            $this->dispatch("remove");
        }
    }
}
