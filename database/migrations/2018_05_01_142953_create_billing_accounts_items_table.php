<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingAccountsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_accounts_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('billing_account_id')->unsigned();
            $table->foreign('billing_account_id')->references('id')->on('billing_accounts')->onDelete('cascade');
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->date('date');
            $table->string('description');
            $table->float('debe')->nullable();
            $table->float('haber')->nullable();
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
        Schema::dropIfExists('billing_accounts_items');
    }
}
