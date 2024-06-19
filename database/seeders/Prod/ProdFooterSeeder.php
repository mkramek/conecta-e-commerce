<?php

namespace Database\Seeders\Prod;

use App\Models\Footer;
use Illuminate\Database\Seeder;

class ProdFooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Footer::create([
            'company_name' => 'Conecta',
            'city' => 'Miasto',
            'street' => 'Ulica',
            'house_number' => 'Numer domu/budynku',
            'apartment_number' => 'Numer mieszkania/lokalu',
            'postal_code' => '00-000',
            'email' => 'kontakt@conecta.pl',
            'telephone_one' => '+48 111 222 333',
            'telephone_two' => null,
            'fax' => null
        ]);
    }
}
