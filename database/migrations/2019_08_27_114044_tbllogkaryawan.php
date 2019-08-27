<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tbllogkaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbllogkaryawan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_karyawan_fk');
			$table->integer('id_jabatan');
			$table->integer('id_status1')->nullable();
			$table->integer('id_status2')->nullable();
			$table->integer('id_unitkerja');
			$table->integer('id_org')->nullable();
			$table->integer('id_posisi')->nullable();
			$table->integer('id_tipe_kar')->nullable();
			$table->integer('id_fungsi')->nullable();
			$table->integer('id_klsjabatan')->nullable();
			$table->integer('id_unit')->nullable();
            $table->timestamp('entry_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_date')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('tbllogkaryawan');
    }
}
