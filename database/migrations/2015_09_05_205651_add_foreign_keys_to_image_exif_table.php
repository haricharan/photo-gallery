<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImageExifTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('image_exif', function(Blueprint $table)
		{
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
		Schema::table('image_exif', function(Blueprint $table)
		{
			$table->dropForeign('image_exif_ibfk_2');
			$table->dropForeign('image_exif_ibfk_1');
		});
	}

}
