<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblunitkerjaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tblunitkerja', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_kategori_unit_kerja_fk')->nullable();
			$table->string('nama_uk', 255);
			$table->integer('jml_formasi');
			$table->integer('jml_existing');
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
		Schema::drop('tblunitkerja');
	}

}
