<?php

namespace App\Livewire\Profile;

use App\Models\Favorite;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class ViewProfile extends Component
{
    use Actions;

    public string $lang;
    public Collection $orders;
    public Collection $favorites;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
        $this->orders = Order::where('user_id', auth()->id())->get();
        $this->favorites = Favorite::where('customer_id', auth()->id())->get();
    }

    public function render(): View
    {
        return view('livewire.profile.view-profile');
    }

    public function remove($id): void
    {
        Favorite::find($id)->delete();
        $this->notification()->success(
            title: __('Usunięto'),
            description: __('Pomyślnie usunięto przedmiot z ulubionych')
        );
    }

    public function status(Order $order) {
        switch($order->status) {
            case "pending":
                return __("Oczekujące");
            case "processing":
                return __("Przetwarzane");
            case "shipped":
                return __("Wysłane");
            case "delivered":
                return __("Dostarczone");
        }
    }
}
