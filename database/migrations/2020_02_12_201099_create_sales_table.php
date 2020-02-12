<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->float('price', 8, 2);
            $table->integer("sale_sub_group_id")->unsigned();
            $table->foreign("sale_sub_group_id")->references("id")->on("sale_sub_groups")->onDelete('cascade');
            $table->integer("room_id")->unsigned();
            $table->foreign("room_id")->references("id")->on("rooms")->onDelete('cascade');
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
        Schema::dropIfExists('sales');
    }
}
