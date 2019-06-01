<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblkaryawanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tblkaryawan', function(Blueprint $table)
		{
			$table->increments('ID');
			$table->string('nama', 100);
			$table->string('gender', 10);
			$table->date('tgl_lahir');
			$table->integer('id_kj');
			$table->integer('id_jabatan');
			$table->integer('id_status1');
			$table->integer('id_status2');
			$table->integer('id_unitkerja');
			$table->date('rencana_mpp');
			$table->date('rencana_pensiun');
			$table->string('pend_diakui', 50);
			$table->integer('id_org');
			$table->integer('id_posisi');
			$table->integer('id_tipe_kar');
			$table->integer('id_fungsi');
			$table->string('nik');
			$table->integer('id_klsjabatan');
			$table->integer('id_unit');
			$table->timestamp('entry_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tblkaryawan');
	}

}
