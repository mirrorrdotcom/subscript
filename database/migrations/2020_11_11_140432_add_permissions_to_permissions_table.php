<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Spatie\Permission\Models\Permission;

class AddPermissionsToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::query()->delete();
    }
}
