<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references("id")->on('reservation_statuses')->onDelete('set null');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references("id")->on("customers")->onDelete("cascade");
            $table->integer('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references("id")->on("partners")->onDelete("cascade");
            $table->integer('payment_option_id')->unsigned()->nullable();
            $table->foreign('payment_option_id')->references("id")->on("payment_options")->onDelete("set null");
            $table->integer('warranty_option_id')->unsigned()->nullable();
            $table->foreign('warranty_option_id')->references("id")->on("warranty_options")->onDelete("set null");
            $table->integer('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references("id")->on("currencies")->onDelete("set null");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation');
    }
}
