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

        Permission::create([
            "name" => "create customers",
            "guard_name" => "api"
        ]);

        Permission::create([
            "name" => "edit customers",
            "guard_name" => "api"
        ]);

        Permission::create([
            "name" => "delete customers",
            "guard_name" => "api"
        ]);
    }
}
