<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        Permission::create([
            "name" => "view customers",
            "guard_name" => "api"
        ]);
    }
}
