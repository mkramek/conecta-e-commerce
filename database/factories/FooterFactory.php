<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Footer>
 */
class FooterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'city' => fake()->city(),
            'street' => fake()->streetName(),
            'house_number' => fake()->randomNumber(2),
            'apartment_number' => fake()->randomNumber(2),
            'postal_code' => fake()->postcode(),
            'email' => fake()->email(),
            'telephone_one' => fake()->randomNumber(9),
            'telephone_two' => null,
            'fax' => fake()->randomNumber(9)
        ];
    }
}
