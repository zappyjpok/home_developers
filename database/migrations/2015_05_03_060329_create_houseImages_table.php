<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('houseImages', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('house_id')->unsigned();
            $table->string('image');
            $table->string('imagePath');
			$table->timestamps();

            $table->foreign('house_id')
                ->references('id')
                ->on('houses')
                ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('houseImages');
	}

}
