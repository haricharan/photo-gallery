<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImagesAlbumsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images_albums', function (Blueprint $table) {
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
        Schema::table('images_albums', function (Blueprint $table) {
            $table->dropForeign('images_albums_ibfk_2');
            $table->dropForeign('images_albums_ibfk_1');
        });
    }
}
