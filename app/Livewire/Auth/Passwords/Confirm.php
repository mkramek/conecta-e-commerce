<?php

namespace App\Livewire\Auth\Passwords;

use Livewire\Component;

class Confirm extends Component
{
    /** @var string */
    public $password = '';

    public function confirm()
    {
        $lang = app()->getLocale();
        $this->validate([
            'password' => 'required|current_password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route("home.$lang"));
    }

    public function render()
    {
        $lang = app()->getLocale();
        return view('livewire.auth.passwords.confirm', ['lang' => $lang])->extends('layouts.auth');
    }
}
