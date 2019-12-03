<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyCreditCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card_warranty', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("reservation_id")->unsigned();
            $table->foreign("reservation_id")->references("id")->on("reservation")->onDelete("cascade");
            $table->integer("credit_card_id")->unsigned();
            $table->foreign("credit_card_id")->references("id")->on("credit_cards")->onDelete("cascade");
            $table->string("cc_number");
            $table->string("cc_expiration_date");
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
        Schema::dropIfExists('credit_card_warranty');
    }
}
