<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('customer_id');
            $table->uuid('car_id');
            $table->string('invoice_no')->nullable()->default('text');
            $table->dateTime('rent_date')->nullable();
            $table->dateTime('back_date')->nullable();
            $table->dateTime('return_date')->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->integer('amount')->unsigned()->nullable();
            $table->integer('penalty')->unsigned()->nullable();
            $table->string('status')->nullable()->default('text');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
