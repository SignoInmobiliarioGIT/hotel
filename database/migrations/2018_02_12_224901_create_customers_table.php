<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("nationality")->nullable();
            $table->integer("document_type")->unsigned();
            $table->foreign("document_type")->references("id")->on("document_types")->onDelete('cascade');
            $table->string("document_number");
            $table->string("phone")->nullable();
            $table->date("birthdate")->nullable();
            $table->string("profession")->nullable();
            $table->string("civil_status")->nullable();
            $table->string("email")->nullable();
            $table->string("address")->nullable();
            $table->string("city")->nullable();
            $table->string("province")->nullable();
            $table->integer("customer_type")->unsigned()->nullable();
            $table->foreign("customer_type")->references("id")->on("customer_types")->onDelete("set null");
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
        Schema::dropIfExists('customers');
    }
}
