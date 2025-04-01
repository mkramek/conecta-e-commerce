<?php

namespace App\Livewire\Newsletter;

use App\Models\NewsletterEmail;
use Error;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class SignUp extends Component
{
    use WireUiActions;

    public $email;

    public function render(): View
    {
        return view('livewire.newsletter.sign-up');
    }

    public function submit(): void
    {
        try {
            $id = auth()->id();
            $nEmail = new NewsletterEmail([
                'user_id' => $id,
                'email' => $this->email
            ]);
            if ($nEmail->save()) {
                $this->email = '';
                $this->notification()->success(
                    title: __("Sukces"),
                    description: __("Twój adres email został zapisany w naszym newsletterze! Dziękujemy!")
                );
            }
        } catch (Error $err) {
            Log::error($err);
            $this->notification()->error(
                title: __("Błąd"),
                description: __("Wystąpił błąd podczas zapisu do newslettera. Spróbuj ponownie później.")
            );
        }
    }
}
