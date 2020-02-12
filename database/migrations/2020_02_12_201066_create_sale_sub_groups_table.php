<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleSubGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_sub_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer("sale_group_id")->unsigned();
            $table->foreign("sale_group_id")->references("id")->on("sale_groups")->onDelete('cascade');
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
        Schema::dropIfExists('sale_sub_groups');
    }
}
