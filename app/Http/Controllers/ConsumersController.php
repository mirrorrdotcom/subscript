<?php

namespace App\Http\Controllers;

use App\Actions\Consumers\CreateConsumerAction;
use App\Actions\Consumers\DeleteConsumerAction;
use App\Actions\Consumers\GetConsumersAction;
use App\Actions\Consumers\UpdateConsumerAction;
use App\Http\Requests\CreateConsumerRequest;
use App\Http\Requests\DeleteConsumerRequest;
use App\Http\Requests\UpdateConsumerRequest;
use App\Models\Consumer;

class ConsumersController extends Controller
{
    public function all()
    {
        return view("consumers.all")
            ->with("consumers", (new GetConsumersAction())->execute());
    }

    public function create()
    {
        return view("consumers.create");
    }


    public function store(CreateConsumerRequest $request)
    {
        if (! (new CreateConsumerAction())->execute($request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not create consumer. Please try again." ]);
        }

        return redirect()->route("consumers.all");
    }

    public function edit(Consumer $consumer)
    {
        return view("consumers.edit")
            ->with("consumer", $consumer);
    }

    public function update(UpdateConsumerRequest $request, Consumer $consumer)
    {
        if (! (new UpdateConsumerAction())->execute($consumer, $request->validated())) {
            return back()
                ->withErrors([ "errors" => "Could not update consumer. Please try again." ]);
        }

        return redirect()->route("consumers.all");
    }

    public function destroy(Consumer $consumer, DeleteConsumerRequest $request)
    {
        if (! (new DeleteConsumerAction())->execute($consumer)) {
            return back()
                ->withErrors([ "error" => "Could not delete consumer. Please try again" ]);
        }

        return redirect()->route("consumers.all");
    }
}
