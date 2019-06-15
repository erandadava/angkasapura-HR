<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableOsperformance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblosperformance', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_pelaporan')->nullable();
            $table->string('keluhan')->nullable();
            $table->longText('file_pelaporan')->nullable();
            $table->date('tanggal_penyelesaian')->nullable();
            $table->string('hasil')->nullable();
            $table->longText('file_penyelesaian')->nullable();
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
        Schema::dropIfExists('tblosperformance');
    }
}
