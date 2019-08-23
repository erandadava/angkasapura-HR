<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KaryawanOS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblkaryawanOS', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->integer('id_fungsi')->nullable();
            $table->integer('id_vendor')->nullable();
            $table->integer('id_unitkerja')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->integer('usia')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('no_bpjs_tk')->nullable();
            $table->longText('doc_no_bpjs_tk')->nullable();
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->longText('doc_no_bpjs_kesehatan')->nullable();
            $table->string('lisensi')->nullable();
            $table->longText('doc_lisensi')->nullable();
            $table->string('no_lisensi')->nullable();
            $table->longText('doc_no_lisensi')->nullable();
            $table->string('jangka_waktu')->nullable();
            $table->string('penempatan')->nullable();
            $table->longText('doc_jangka_waktu')->nullable();
            $table->string('no_kontrak_kerja')->nullable();
            $table->longText('doc_no_kontrak_kerja')->nullable();
            $table->longText('reason_desc')->nullable();
            $table->enum('is_active',['R','A','N'])->nullable();
            $table->date('tmt_awal_kontrak')->nullable();
            $table->date('tmt_akhir_kontrak')->nullable();
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
        Schema::dropIfExists('tblkaryawanOS');
    }
}
