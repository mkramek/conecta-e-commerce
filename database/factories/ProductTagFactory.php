<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductTag>
 */
class ProductTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => array_rand($this->randomProductTagNames, 1),
            'lang' => "pl"
        ];
    }

    /**
     * Przykładowe losowe tagi.
     *
     * @var array|string[]
     */
    private array $randomProductTagNames = ["Nowość", "Promocja", "Wyprzedaż", "Ostatnie sztuki"];
}
