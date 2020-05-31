<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        Currency::create([
            "name" => "US Dollars",
            "code" => "usd",
            "symbol" => "$",
            "rate" => 1.0,
            "is_active" => true
        ]);
    }
}
