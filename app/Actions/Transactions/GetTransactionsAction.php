<?php

namespace App\Actions\Transactions;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

class GetTransactionsAction
{
    public function execute(): Collection
    {
        return Transaction::with('customer')->latest()
            ->get();
    }
}
