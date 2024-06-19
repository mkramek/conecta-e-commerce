<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientECommerce>
 */
class ClientECommerceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $email = Str::lower($firstName . "_" . $lastName . "@" . "example.com");

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'login' => $firstName . "_" . $lastName,
            'email' => $email,
            'telephone_prefix' => fake()->boolean ? '+48' : null,
            'telephone_number' => fake()->boolean ? '000 111 222' : null,
            'password' => bcrypt('Qwerty123'),
            'is_account_blocked' => false,
            'allow_newsletter' => fake()->boolean,
            'rodo_acceptance' => fake()->boolean,
            'marketing_agreement' => fake()->boolean
,        ];
    }
}
