<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_copies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('image_id')->unsigned()->index();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('image_size_id')->unsigned()->index();
            $table->foreign('image_size_id')->references('id')->on('image_sizes')->onDelete('restrict');
            $table->string('filename');
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
        Schema::drop('image_copies');
    }
}
