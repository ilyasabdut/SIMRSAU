<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbBiopasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_biopasiens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NIK',16);
            $table->string('no_rm',5);
            $table->string('status',20);
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan']);
            $table->string('alamat',50);
            $table->string('no_telp',15);
            $table->enum('gol_darah',['A','B','AB','O']);
            $table->date('tgl_lahir');
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
        Schema::dropIfExists('tb_biopasiens');
    }
}
