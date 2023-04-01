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
        Schema::create('doc__outbounds', function (Blueprint $table) {
            $table->increments('doc_Id');
            $table->integer('outbound_Detail_Id')->unsigned();
            $table->integer('doc_Category_Id')->unsigned();
            $table->string('title')->collation('utf8_general_ci');
            $table->date('date');
            $table->string('from')->collation('utf8_general_ci');
            $table->string('send_to')->collation('utf8_general_ci');
            $table->foreign('outbound_Detail_Id')->references('outbound_Detail_Id')->on('outbound__details');
            $table->foreign('doc_Category_Id')->references('doc_Category_Id')->on('document__categories');
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
        Schema::dropIfExists('doc__outbounds');
    }
};
