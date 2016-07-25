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
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('image_id')->unsigned();
            $table->bigInteger('exif_id')->unsigned();
            $table->string('value');
            $table->timestamps();

            $table->unique(['image_id', 'exif_id'], 'idx_ie1');
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
