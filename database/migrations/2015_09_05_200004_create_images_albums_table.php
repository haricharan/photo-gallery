<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesAlbumsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_albums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('image_id')->unsigned()->index('idx_ia1');
            $table->bigInteger('album_id')->unsigned()->index('idx_ia2');
            $table->timestamps();

            $table->foreign('image_id', 'images_albums_ibfk_2')->references('id')->on('images')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('album_id', 'images_albums_ibfk_1')->references('id')->on('albums')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images_albums');
    }
}
