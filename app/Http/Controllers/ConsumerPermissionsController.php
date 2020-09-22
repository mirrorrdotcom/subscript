<?php

namespace App\Http\Controllers;

use App\Actions\Permissions\GetConsumerPermissions;
use App\Actions\Permissions\GetPermissions;
use App\Http\Requests\UpdateConsumerPermissionsRequest;
use App\Models\Consumer;

class ConsumerPermissionsController extends Controller
{
    public function edit(Consumer $consumer)
    {
        return view("consumers.permissions.edit")
            ->with("consumer", $consumer)
            ->with("currentPermissions", (new GetConsumerPermissions())->execute($consumer))
            ->with("permissions", (new GetPermissions())->execute());
    }

    public function update(Consumer $consumer, UpdateConsumerPermissionsRequest $request)
    {
        $consumer->syncPermissions($request->validated());

        return redirect()->route("consumers.permissions.edit", [ "consumer" => $consumer->id ]);
    }
}
