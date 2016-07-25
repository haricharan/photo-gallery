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
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('image_id')->unsigned();
            $table->bigInteger('iptc_id')->unsigned();
            $table->string('value');
            $table->timestamps();

            $table->unique(['image_id', 'iptc_id'], 'idx_ii1');
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
