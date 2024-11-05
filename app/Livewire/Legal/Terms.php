<?php

namespace App\Livewire\Legal;

use App\Models\Regulation;
use App\Models\RegulationCategory;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Terms extends Component
{
    public Collection $regulations;
    public bool $terms = false;

    public function mount()
    {
        $this->terms = intval(request()->query('privacy')) === 1;
        $terms_categories = RegulationCategory::where('name', '=', 'Polityka prywatności')->pluck('id')->toArray();
        $other_categories = RegulationCategory::where('name', '<>', 'Polityka prywatności')->pluck('id')->toArray();
        if ($this->terms) {
            $this->regulations = Regulation::whereIn('regulation_category_id', $terms_categories)->get();
        } else {
            $this->regulations = Regulation::whereIn('regulation_category_id', $other_categories)->get();
        }
    }

    public function render()
    {
        return view('livewire.legal.terms');
    }
}
