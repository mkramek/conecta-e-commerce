<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\SizeGroup;
use Illuminate\Database\Seeder;

class DevSizeGroupsAndSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Utworzenie grup rozmiarów.
        $emptySizeGroup = SizeGroup::create(['group_name' => 'Brak', 'group_code' => 'GC0']);
        $shoes = SizeGroup::create(['group_name' => 'Buty', 'group_code' => 'GC1']);
        $gloves = SizeGroup::create(['group_name' => 'Rękawice', 'group_code' => 'GC2']);
        $clothes = SizeGroup::create(['group_name' => 'Odzież', 'group_code' => 'GC3']);
        $trousers = SizeGroup::create(['group_name' => 'Spodnie', 'group_code' => 'GC4']);

        // Przypisanie rozmiarów do grupy: Buty (rozmiary od 35-38)
        for ($i=35; $i<=38; $i++) {
            $shoes->sizes()->create([
                'size_value' => $i
            ]);
        }

        // Przypisanie rozmiarów do grupy rękawice: Rozmiary 06-11 / XS-XL
        $this->createGloveSizes($gloves);

        // Przypisanie rozmiarów do grupy: Odzież (XS-3XL)
        $this->createClotheSizes($clothes);

        // Przypisanie rozmiarów do grupy: Spodnie (25-60)
        for ($i=25; $i<=60; $i++) {
            $trousers->sizes()->create([
                'size_value' => $i
            ]);
        }
    }


    /**
     * Tworzenie rozmiarów dla grupy Rękawice.
     *
     * @param SizeGroup $gloves
     * @return void
     */
    private function createGloveSizes(SizeGroup $gloves): void
    {
        $gloves->sizes()->create([
            'size_value' => 'XS'
        ]);

        $gloves->sizes()->create([
            'size_value' => 'S'
        ]);

        $gloves->sizes()->create([
            'size_value' => 'M'
        ]);

        $gloves->sizes()->create([
            'size_value' => 'L'
        ]);

        $gloves->sizes()->create([
            'size_value' => 'XL'
        ]);

        $gloves->sizes()->create([
            'size_value' => '2XL'
        ]);
    }

    /**
     * Tworzenie rozmiarów dla grupy Odzież.
     *
     * @param SizeGroup $clothes
     * @return void
     */
    private function createClotheSizes(SizeGroup $clothes): void
    {
        $clothes->sizes()->create([
            'size_value' => 'XS'
        ]);

        $clothes->sizes()->create([
            'size_value' => 'S'
        ]);

        $clothes->sizes()->create([
            'size_value' => 'M'
        ]);

        $clothes->sizes()->create([
            'size_value' => 'L'
        ]);

        $clothes->sizes()->create([
            'size_value' => 'XL'
        ]);

        $clothes->sizes()->create([
            'size_value' => '2XL'
        ]);

        $clothes->sizes()->create([
            'size_value' => '3XL'
        ]);
    }
}
