<?php

namespace App\Http\Controllers;

use App\Actions\Transactions\GetTransactionsAction;

class TransactionsController extends Controller
{
    public function all()
    {
        return view("transactions.all")
            ->with("transactions", (new GetTransactionsAction())->execute());
    }
}
