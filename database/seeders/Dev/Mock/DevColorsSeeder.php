<?php

namespace Database\Seeders\Dev\Mock;

use App\Models\Color;
use Illuminate\Database\Seeder;

class DevColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::firstOrCreate([
            'name' => 'Czerwony'
        ]);

        Color::firstOrCreate([
            'name' => 'Niebieski'
        ]);

        Color::firstOrCreate([
            'name' => 'Zielony'
        ]);

        Color::firstOrCreate([
            'name' => 'Biały'
        ]);

        Color::firstOrCreate([
            'name' => 'Czarny'
        ]);

        Color::firstOrCreate([
            'name' => 'Szary'
        ]);

        Color::firstOrCreate([
            'name' => 'Limonkowy'
        ]);

        Color::firstOrCreate([
            'name' => 'Błękitny'
        ]);

        Color::firstOrCreate([
            'name' => 'Pomarańczowy'
        ]);

        Color::firstOrCreate([
            'name' => 'Srebrny'
        ]);

        Color::firstOrCreate([
            'name' => 'Turkusowy'
        ]);

        Color::firstOrCreate([
            'name' => 'Złoty'
        ]);

        Color::firstOrCreate([
            'name' => 'Fioletowy'
        ]);

        Color::firstOrCreate([
            'name' => 'Zółty'
        ]);

        Color::firstOrCreate([
            'name' => 'Błękit'
        ]);
    }
}
