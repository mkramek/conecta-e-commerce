<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankConfiguration>
 */
class BankConfigurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_name' => 'Nazwa banku...',
            'bank_transfer_title' => "Tytuł przelewu...",
            'bank_account_number' => fake()->iban('PL')
        ];
    }
}
