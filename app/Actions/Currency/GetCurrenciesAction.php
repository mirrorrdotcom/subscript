<?php

namespace App\Actions\Currency;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class GetCurrenciesAction
{
    public function execute(): Collection
    {
        return Currency::all();
    }
}
