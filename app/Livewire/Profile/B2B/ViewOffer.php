<?php

namespace App\Livewire\Profile\B2B;

use App\Models\Cart;
use App\Models\IndividualOffer;
use App\Models\IndividualOfferItem;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class ViewOffer extends Component
{
    public IndividualOffer $offer;

    public IndividualOffer|null $counter = null;

    public Collection $counter_items;

    public string $lang;

    public bool $has_counter_already = false;

    protected array $rules = [
        'counter_items.*.quantity' => 'int',
        'counter_items.*.price_net' => 'float',
        'counter_items.*.price_gross' => 'float',
    ];

    public function mount(IndividualOffer|null $offer)
    {
        $this->lang = app()->getLocale();
        $this->has_counter_already = IndividualOffer::where('parent_id', $offer->id)->exists();
        $this->counter_items = collect();
    }

    public function render()
    {
        return view('livewire.profile.b2-b.view-offer');
    }

    public function counterOffer()
    {
        $existing = IndividualOffer::where('parent_id', $this->offer->id)->whereNull('accepted_at')->whereNull('rejected_at');
        if ($existing->exists()) {
            $this->counter = $existing->first();
            $this->counter_items = collect($this->counter->items);
        } else {
            $this->counter = $this->offer;
            $this->counter_items = collect($this->offer->items);
        }
        Log::info($this->counter_items);
    }

    public function approveOffer()
    {
        if ($this->offer->accepted_at === null) {
            $this->offer->accepted_at = now();
            $this->offer->save();
        }
        Cart::where('customer_id', $this->offer->customer_id)->delete();
        foreach ($this->offer->items as $item) {
            Cart::create([
                'customer_id' => $this->offer->customer_id,
                'variant_id' => $item->variant->id,
                'product_id' => $item->variant->product->id,
                'quantity' => $item->quantity,
                'is_customizable' => $item->variant->product->is_customizable,
                'custom_price_net' => $item->price_net,
                'custom_price_gross' => $item->price_gross,
            ]);
        }

        redirect()->route("cart.{$this->lang}");
    }

    public function sendCounterOffer()
    {
        $existing = IndividualOffer::where('parent_id', $this->offer->id)->whereNull('accepted_at')->whereNull('rejected_at');

        $counter = $existing->first() ?? IndividualOffer::create([
            ...$this->counter->getAttributes(),
            'parent_id' => $this->counter->id,
            'is_from_customer' => true,
        ]);

        IndividualOfferItem::whereIn('id', $counter->items->pluck('id'))->delete();

        foreach ($this->counter_items as $item) {
            IndividualOfferItem::create([
                ...$item->getAttributes(),
                'individual_offer_id' => $counter->id,
            ]);
        }

        $this->counter = null;

        redirect()->route("b2b.$this->lang");
    }

    public function cancelCounterOffer()
    {
        $this->counter->forceDelete();
        $this->counter = null;
    }

    public function rejectCounterOffer()
    {
        $this->offer->update(['rejected_at' => Carbon::now()]);
        redirect()->route("b2b.$this->lang");
    }

    public function updated(string $field)
    {
        if (str_starts_with($field, "counter_items.")) {
            [$arr, $key, $name] = explode(".", $field);
            $item = $this->counter_items->get($key);
            $vat = $item->variant->vat_rate;
            if ($item->price_gross === "" || $item->price_net === "") {
                $item->price_gross = 0;
                $item->price_net = 0;
            } else if ($name === "price_net") {
                $item->price_gross = number_format($item->price_net * (1 + $vat / 100), 2, ".", "");
                $this->counter_items->put($key, $item);
            } else if ($name === "price_gross") {
                $item->price_net = number_format($item->price_gross / (1 + $vat / 100), 2, ".", "");
                $this->counter_items->put($key, $item);
            }
        }
    }
}
