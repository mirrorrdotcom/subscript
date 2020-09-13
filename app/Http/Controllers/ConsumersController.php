<?php

namespace App\Http\Controllers;

use App\Actions\Consumers\CreateConsumerAction;
use App\Actions\Consumers\GetConsumersAction;
use App\Http\Requests\CreateConsumerRequest;
use Illuminate\Http\Request;

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
        if (!(new CreateConsumerAction())->execute($request->validated())) {
            return back()
                ->withErrors([ "error" => "Could not create customer. Please try again." ]);
        }

        return redirect()->route("consumers.all");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
