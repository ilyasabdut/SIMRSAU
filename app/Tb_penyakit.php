<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_penyakit extends Model
{
   protected $table = "tb_penyakits";

   protected $fillable = [
        'nama_penyakit','kd_penyakit'
    ];
}
