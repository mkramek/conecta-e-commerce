<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Size>
 */
class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size_value' => array_rand($this->sizes)
        ];
    }

    private array $sizes = ["8", "9", "10", "XS", "S", "M", "L", "XL", "XXL", "41", "42", "43", "44"];
}
