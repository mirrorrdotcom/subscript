<?php

namespace App\Http\Controllers;

use App\Actions\Currency\CreateCurrencyAction;
use App\Actions\Currency\DeleteCurrencyAction;
use App\Actions\Currency\GetCurrenciesAction;
use App\Actions\Currency\UpdateCurrencyAction;
use App\Http\Requests\Currency\CreateCurrencyRequest;
use App\Http\Requests\Currency\DeleteCurrencyRequest;
use App\Http\Requests\Currency\UpdateCurrencyRequest;
use App\Models\Currency;

class CurrenciesController extends Controller
{
    public function all()
    {
        return view("currencies.all")
            ->with("currencies", (new GetCurrenciesAction())->execute());
    }

    public function create()
    {
        return view("currencies.create");
    }

    public function store(CreateCurrencyRequest $request)
    {
        if (!(new CreateCurrencyAction())->execute($request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not create currency. Please try again." ]);
        }

        return redirect()->route("currencies.all");
    }

    public function edit(Currency $currency)
    {
        return view("currencies.edit")->with("currency", $currency);
    }

    public function update(Currency $currency, UpdateCurrencyRequest $request)
    {
        if (!(new UpdateCurrencyAction())->execute($currency, $request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not update currency. Please try again." ]);
        }

        return redirect()->route("currencies.all");
    }

    public function destroy(Currency $currency, DeleteCurrencyRequest $request)
    {
        if (!(new DeleteCurrencyAction())->execute($currency)) {
            return back()
                ->withErrors([ "error" => "Could not delete currency. Please try again." ]);
        }

        return redirect()->route("currencies.all");
    }
}
