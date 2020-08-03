<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id')->uniqid();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->float('lng')->nullable();
            $table->float('lat')->nullable();
            $table->string('departement')->nullable();
            $table->string('adr')->nullable();
            $table->mediumText('img')->nullable();
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
        Schema::dropIfExists('places');
    }
}
