<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WarehouseAddress>
 */
class WarehouseAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city' => fake()->city,
            'street' => fake()->streetName,
            'house_number' => fake()->randomNumber(2),
            'apartment_number' => null,
            'postal_code' => fake()->postcode,
            'province' => "Mazowieckie",
            'country' => fake()->country,
            'additional_info' => fake()->text(50),
        ];
    }
}
