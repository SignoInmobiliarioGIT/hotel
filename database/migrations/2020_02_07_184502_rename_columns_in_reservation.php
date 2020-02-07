<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsInReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->renameColumn('status_id', 'reservation_status_id');
            $table->renameColumn('children', 'minors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->renameColumn('reservation_status_id', 'status_id');
            $table->renameColumn('minors', 'children');
        });
    }
}
