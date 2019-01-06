<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbBiodoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_biodokters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NIK',16);
            $table->string('kd_dokter',5);
            $table->string('bidang',15);
            $table->string('pangkat',20);
            $table->timestamps();

            $table->foreign('id')
             ->references('id')->on('tb_users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_biodokters');
    }
}
