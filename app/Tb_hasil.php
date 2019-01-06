<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_hasil extends Model
{
        protected $table = "tb_hasils";

        protected $fillable = [
      'user_id','no_rm','nama_pasien','nama_dokter','nama_perawat', 'catatan_dokter','kd_obat','kd_penyakit'
    ];

        public function hasilpasiens()
    {
    	return $this->belongsTo("App\User");
    }

   
}
