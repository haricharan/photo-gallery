<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageIptcTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_iptc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('image_id')->unsigned();
            $table->bigInteger('iptc_id')->unsigned();
            $table->string('value');
            $table->timestamps();

            $table->unique(['image_id', 'iptc_id'], 'idx_ii1');
            $table->foreign('iptc_id', 'image_iptc_ibfk_2')->references('id')->on('iptc')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('image_id', 'image_iptc_ibfk_1')->references('id')->on('images')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void 
     */
    public function down()
    {
        Schema::drop('image_iptc');
    }
}
