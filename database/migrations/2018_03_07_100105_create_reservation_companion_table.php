<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationCompanionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_companion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("reservation_id")->unsigned();
            $table->foreign("reservation_id")->references("id")->on("reservation")->onDelete('cascade');
            $table->string("dni");
            $table->string("name");
            $table->integer("age")->nullable();
            $table->string("relationship")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_companion');
    }
}
