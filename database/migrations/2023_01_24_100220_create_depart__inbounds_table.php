<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depart__inbounds', function (Blueprint $table) {
            $table->increments('depart_Inbound_Id');
            $table->integer('depart_Id')->unsigned();
            $table->integer('inbound_to_Depart_Id')->unsigned();
            $table->foreign('depart_Id')->references('depart_Id')->on('departments');
            $table->foreign('inbound_to_Depart_Id')->references('inbound_to_Depart_Id')->on('inbound_to__departments');
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
        Schema::dropIfExists('depart__inbounds');
    }
};
