<?php

namespace App\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    /** @var string */
    public $lang;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
    }

    public function authenticate(): RedirectResponse|null
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', __('auth.failed'));

            return null;
        }
        $back = request()->query('back');
        if ($back) {
            return redirect()->intended("/$back");
        }

        return redirect()->intended(route("home.{$this->lang}"));
    }

    public function render(): View
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
