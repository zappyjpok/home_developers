<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('featureImages', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('feature_id')->unsigned();
            $table->string('image');
            $table->string('imagePath');
			$table->timestamps();

            $table->foreign('feature_id')
                ->references('id')
                ->on('features')
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
		Schema::drop('featureImages');
	}

}
