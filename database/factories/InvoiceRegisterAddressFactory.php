<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceRegisterAddress>
 */
class InvoiceRegisterAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company,
            'nip' => fake()->randomNumber(10),
            'city' => fake()->city,
            'street' => fake()->streetName,
            'house_number' => fake()->randomNumber(2),
            'apartment_number' => null,
            'postal_code' => fake()->postcode,
        ];
    }
}

//"996c2389-99f5-43ef-83f3-fd7d25255525"
//111-222-33-44
