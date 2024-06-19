<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SizeGroup>
 */
class SizeGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_name' => array_rand($this->groupNames),
            'group_code' => "SGC" . fake()->randomNumber(4)
        ];
    }

    private array $groupNames = ["Buty", "Rękawice", "Odzież", "Spodnie"];
}
