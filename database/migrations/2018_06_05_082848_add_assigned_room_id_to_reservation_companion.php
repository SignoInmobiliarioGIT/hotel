<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssignedRoomIdToReservationCompanion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_companion', function (Blueprint $table) {
            $table->integer("assigned_room_id")->unsigned()->nullable();
            $table->foreign("assigned_room_id")->references("id")->on("rooms")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
