<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("name");
            $table->string("floor");
            $table->string("description")->nullable();
            $table->integer("status")->unsigned()->nullable();
            $table->foreign("status")->references("id")->on("state_of_service")->onDelete("set null");
            $table->integer("cleaning_status")->unsigned()->nullable();
            $table->foreign("cleaning_status")->references("id")->on("cleaning_statuses")->onDelete("set null");
            $table->integer("room_category")->unsigned()->nullable();
            $table->foreign("room_category")->references("id")->on("room_categories")->onDelete("set null");
            $table->boolean('baby_crib')->default(0);
            $table->boolean('sofa')->default(0);
            $table->boolean('extra_bed')->default(0);
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
        Schema::dropIfExists('rooms');
    }
}
