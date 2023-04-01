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
        Schema::create('outbound__details', function (Blueprint $table) {
            $table->increments('outbound_Detail_Id');
            $table->integer('user_Id')->unsigned();
            $table->string('send_to')->collation('utf8_general_ci');
            $table->string('title')->collation('utf8_general_ci');
            $table->integer('doc_No');
            $table->string('doc_Title')->collation('utf8_general_ci');
            $table->integer('doc_Quantity');
            $table->string('note')->collation('utf8_general_ci');
            
            $table->foreign('user_Id')->references('user_Id')->on('users');   
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
        Schema::dropIfExists('outbound__details');
    }
};
