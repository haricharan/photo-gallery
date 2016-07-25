<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImageIptcTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_iptc', function (Blueprint $table) {
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
        Schema::table('image_iptc', function (Blueprint $table) {
            $table->dropForeign('image_iptc_ibfk_2');
            $table->dropForeign('image_iptc_ibfk_1');
        });
    }
}
