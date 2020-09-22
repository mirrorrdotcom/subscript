<?php

namespace App\Actions\Permissions;

use Spatie\Permission\Models\Permission;

class GetPermissions
{
    public function execute()
    {
        return Permission::select("id", "name")
            ->orderBy("name", "asc")
            ->get()
            ->pluck("name", "id")
            ->toArray();
    }
}