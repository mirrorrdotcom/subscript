<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call(CurrencySeeder::class);
         $this->call(PermissionSeeder::class);
    }
}
