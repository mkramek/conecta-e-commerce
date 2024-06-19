<?php

namespace Database\Seeders\Prod;

use App\Models\BankConfiguration;
use Illuminate\Database\Seeder;

class ProdBankConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankConfiguration::create([
            'bank_name' => 'Nazwa banku',
            'bank_transfer_title' => 'Tytuł przelewu',
            'bank_account_number' => 'PL92561200872132644477620909'
        ]);
    }
}
