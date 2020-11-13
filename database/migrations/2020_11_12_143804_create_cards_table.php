<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->unsignedBigInteger('customer_id');

            $table->string('expiry_month', 2);
            $table->string('expiry_year', 4);
            $table->string('name');
            $table->string('scheme');
            $table->string('last_four', 4);
            $table->string('fingerprint');
            $table->string('bin');
            $table->string('card_type');
            $table->string('card_category')->nullable();
            $table->string('issuer');
            $table->string('country');
            $table->string('product_id');
            $table->string('product_type');
            $table->string('avs_check');
            $table->string('cvv_check');
            $table->boolean('payouts');
            $table->timestamps();

            $table->foreign('source_id')
                ->references('id')
                ->on('sources');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
