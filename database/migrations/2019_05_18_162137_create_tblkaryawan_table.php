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
			$table->increments('id');
			$table->string('nama', 100);
			$table->string('gender', 10);
			$table->date('tgl_lahir');
			$table->integer('id_jabatan');
			$table->integer('id_status1')->nullable();
			$table->integer('id_status2')->nullable();
			$table->integer('id_unitkerja');
			$table->date('rencana_mpp');
			$table->date('rencana_pensiun');
			$table->string('pend_diakui', 50);
			$table->string('pend_milik', 50);
			$table->integer('id_org')->nullable();
			$table->integer('id_posisi')->nullable();
			$table->integer('id_tipe_kar')->nullable();
			$table->integer('id_fungsi');
			$table->string('nik');
			$table->integer('id_klsjabatan')->nullable();
			$table->integer('id_unit')->nullable();
			$table->enum('status_pensiun',['A','M','R','N'])->default('N')->nullable();
			$table->date('tgl_aktif_pensiun')->nullable();
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
