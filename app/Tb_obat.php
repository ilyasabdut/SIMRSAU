<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_obat extends Model
{
   protected $table = "tb_obats";

   protected $fillable = [
        'nama_obat','kd_obat'
    ];
}
