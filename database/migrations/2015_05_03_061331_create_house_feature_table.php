<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseFeatureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('house_feature', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('house_id')->unsigned()->index();
            $table->foreign('house_id')
                ->references('id')
                ->on('houses')
                ->onDelete('cascade');

            $table->integer('feature_id')->unsigned()->index();
            $table->foreign('feature_id')
                ->references('id')
                ->on('features')
                ->onDelete('cascade');

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
		Schema::drop('house_feature');
	}

}
