<?php

namespace Database\Factories;

use App\Core\Enums\PolishProvinces;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
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
            'apartment_number' => fake()->numberBetween(1, 150),
            'postal_code' => fake()->postcode,
            'province' => array_rand(PolishProvinces::cases()),
            'country' => 'Polska',
            'additional_info' => null
        ];
    }
}
