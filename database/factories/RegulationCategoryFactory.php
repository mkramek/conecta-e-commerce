<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegulationCategory>
 */
class RegulationCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => array_rand($this->regulationCategoryNames, 1)
        ];
    }

    private array $regulationCategoryNames = ["Zwroty", "Promocje", "RODO", "Newsletter"];
}
