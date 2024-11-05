<?php

namespace App\Livewire\Customer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public string $lang;
    public Collection $items;
    public float $total_brutto;
    public float $total_discount_brutto = 0.0;
    public bool $has_discounts;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
        $this->items = $this->getItems();
        $this->total_brutto = $this->getTotal(false);
        $this->total_discount_brutto = $this->getTotal();
    }

    public function getItems(): Collection
    {
        return \App\Models\Cart::where(['customer_id' => auth()->id() ?? session()->getId()])->get();
    }

    public function getTotal($with_discounts = true): float
    {
        $total = array_reduce([...$this->items], function ($acc, $item) use ($with_discounts) {
            $quantity = $item->quantity < 1 ? 1 : $item->quantity;
            if ($item->variant->brutto_discount_price) $this->has_discounts = true;
            if ($with_discounts) {
                return $acc + $quantity * ($item->variant->brutto_discount_price ?? $item->variant->brutto_price);
            }
            return $acc + $quantity * $item->variant->brutto_price;
        }, 0.0);
        return $total;
    }

    public function render(): View
    {
        return view('livewire.customer.cart');
    }

    #[On('new_quantity')]
    public function updateTotals($event): void
    {
        $target = \App\Models\Cart::find($event['item']);
        if ($target) {
            $quantity = $event['quantity'] < 1 ? 1 : $event['quantity'];
            $target->update(['quantity' => $quantity]);
            $this->items = $this->getItems();
            $this->total_brutto = $this->getTotal();
        }
    }

    #[On('remove')]
    public function refetch(): void
    {
        $this->items = $this->getItems();
    }

    public function checkout(): Redirector|RedirectResponse
    {
        return redirect()->route("checkout.{$this->lang}");
    }
}
