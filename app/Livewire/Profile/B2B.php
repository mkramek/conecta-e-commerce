<?php

namespace App\Livewire\Profile;

use App\Models\IndividualOffer;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class B2B extends Component
{
    public Collection $offers;

    #[Url]
    public ?string $tab = 'products';

    public function mount(): void
    {
        $currentCustomer = auth()->user();
        $this->offers = IndividualOffer::with('items')->whereNull('rejected_at')->whereIn('customer_id', [$currentCustomer->parent_id, $currentCustomer->id])->get();
    }

    public function render()
    {
        return view('livewire.profile.b2-b');
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
    }
}
