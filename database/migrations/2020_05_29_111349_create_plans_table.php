<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subscription_model_id");
            $table->string("slug");
            $table->string("name");
            $table->text("description")->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer("trial_period");
            $table->integer("trial_interval");
            $table->integer("recurring_period");
            $table->integer("recurring_interval");
            $table->integer("grace_period");
            $table->integer("grace_interval");
            $table->integer("sort_order")->default(0);
            $table->timestamps();
            $table->softDeletes();
            // Foreign Keys
            $table->foreign("subscription_model_id")
                ->references("id")
                ->on("subscription_models");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
