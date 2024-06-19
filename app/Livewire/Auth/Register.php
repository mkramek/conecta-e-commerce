<?php

namespace App\Livewire\Auth;

use App\Mail\Customer\CustomerCreated;
use App\Models\ClientECommerce as User;
use App\Models\CompanyConfig;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Component;

class Register extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $login = '';
    public $email = '';
    public $telephone_prefix = '';
    public $telephone_number = '';
    public $password = '';
    public $password_confirmation = '';
    public $allow_newsletter = false;
    public $rodo_acceptance = false;
    public $marketing_agreement = false;

    public $lang;

    public function mount(): void
    {
        $this->lang = app()->getLocale();
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'login' => 'required',
            'email' => 'required|email',
            'telephone_prefix' => 'required|min:1|numeric',
            'telephone_number' => 'required|min:1|numeric',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'allow_newsletter' => 'boolean',
            'rodo_acceptance' => 'boolean|required',
            'marketing_agreement' => 'boolean',
        ];
    }

    public function register()
    {
        $lang = app()->getLocale();

        $validated = $this->validate();
        $user = User::create([
            ...$validated,
            'password' => password_hash($validated['password'], PASSWORD_BCRYPT)
        ]);

        event(new Registered($user));
        Mail::to($user->email)->send(new CustomerCreated($user));
        Auth::login($user, true);

        return redirect(route("home.$lang"));
    }

    public function render(): View
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
