<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbHasilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hasils', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_rm',5);
            $table->string('kd_dokter',5);
            $table->string('kd_penyakit',5);
            $table->string('kd_obat',5);
            $table->string('nama_pasien',25);
            $table->string('nama_dokter',25);
            $table->string('nama_perawat',25);
            $table->string('nama_penyakit',25);
            $table->string('nama_obat',25);
            $table->string('catatan_dokter',50);
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
        Schema::dropIfExists('tb_hasils');
    }
}
