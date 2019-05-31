<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbljabatanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbljabatan', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->string('nama_jabatan', 50);
			$table->text('syarat_didik');
			$table->text('syarat_latih');
			$table->text('syarat_pengalaman');
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
		Schema::drop('tbljabatan');
	}

}
