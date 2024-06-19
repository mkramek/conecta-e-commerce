<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Producer;
use App\Models\SizeGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private string $productModel = "";
    private string $productName = "";
    private string $color = "";
    private string $size = "";
    private int $sizeGroupId = 0;
    private string $producer = "";
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Model
        $this->productModel = fake()->randomNumber("4");

        // Producer
        $producers = ["3M", "ABC", "Figo", "Bravo", "Alfa", "North"];
        $randKeyForProducers = array_rand($producers);
        $this->producer = $producers[$randKeyForProducers];

        Producer::firstOrCreate(['name' => $this->producer]);

        return [
            'name_pl' => fake()->text(20),
            'slug_pl' => Str::slug(fake()->text(20)),
            'name_en' => fake()->text(20),
            'slug_en' => Str::slug(fake()->text(20)),
            'producer' => $this->producer,
            'model' => $this->productModel,
            'vat_rate' => 23,
        ];
    }

    private function getFullProductCode(): string
    {
        // KOD TOWARU: MODEL.GRUPA_ROZMIAROWA.ROZMIAR.KOLOR.PRODUCENT
        $code = "";
        $this->productModel = fake()->randomNumber("4");
        $productNames = ['Testowy1', 'Testowy2', 'Testowy3'];
        $randKeyForProductNames = array_rand($productNames);
        $this->productName = $productNames[$randKeyForProductNames] . " " . $this->productModel;

        // Size
        $sizeGroup = SizeGroup::all()->random(1)->first();

        if ($sizeGroup->id == 1) {
            $code .= $this->productModel . ".GC0.00.";
        } else {
            $this->size = $sizeGroup->sizes()->first()->size_value;
            $this->sizeGroupId = $sizeGroup->id;
            $code .= $this->productModel . "." . $sizeGroup->group_code . "." . $this->size . ".";
        }

        // Color
        $this->color = Color::firstOrCreate(['name' => str_replace(' ', '_', Str::ucfirst(fake()->safeColorName))])->name;

        $code .= $this->color . ".";

        // Producer
        $producers = ["3M", "ABC", "Figo", "Bravo", "Alfa", "North"];
        $randKeyForProducers = array_rand($producers);
        $this->producer = $producers[$randKeyForProducers];

        Producer::firstOrCreate(['name' => $this->producer]);

        $code .= $this->producer;

        return $code;
    }
}
