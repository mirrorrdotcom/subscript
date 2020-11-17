<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('source_id')->nullable();
            $table->morphs('payable');

            $table->string('payment_id')->unique();
            $table->string('eci');
            $table->string('scheme_id');
            $table->string('response_code');
            $table->string('response_summary')->nullable();
            $table->string('auth_code');
            $table->string('currency');
            $table->string('amount');
            $table->string('reference')->nullable();
            $table->string('status');
            $table->boolean('approved');
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
        Schema::dropIfExists('payments');
    }
}
