<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblosdocTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tblosdoc', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->integer('ID_kar');
			$table->text('doc_bpsj');
			$table->text('doc_bpjsk');
			$table->text('doc_lisensi');
			$table->text('doc_nomlisensi');
			$table->text('jangkawaktu');
			$table->text('kontrakkerja');
			$table->softDeletes();
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
		Schema::drop('tblosdoc');
	}

}
