<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageExifTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_exif', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('image_id')->unsigned();
            $table->bigInteger('exif_id')->unsigned();
            $table->string('value');
            $table->timestamps();

            $table->unique(['image_id', 'exif_id'], 'idx_ie1');
            $table->foreign('exif_id', 'image_exif_ibfk_2')->references('id')->on('exif')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('image_id', 'image_exif_ibfk_1')->references('id')->on('images')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('image_exif');
    }
}
