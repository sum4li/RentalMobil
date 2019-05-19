<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('manufacture_id');
            $table->string('name')->nullable()->default('text');
            $table->string('license_number')->nullable()->default('text');
            $table->string('color')->nullable()->default('text');
            $table->string('year')->nullable()->default('text');
            $table->string('status')->nullable()->default('text');
            $table->integer('price')->unsigned()->nullable();
            $table->integer('penalty')->unsigned()->nullable();
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
        Schema::dropIfExists('cars');
    }
}
