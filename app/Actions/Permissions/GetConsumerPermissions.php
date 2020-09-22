<?php

namespace App\Actions\Permissions;

use App\Models\Consumer;

class GetConsumerPermissions
{
    public function execute(Consumer $consumer)
    {
        return $consumer->permissions()
            ->orderBy("name", "asc")
            ->get()
            ->pluck("id")
            ->toArray();
    }
}