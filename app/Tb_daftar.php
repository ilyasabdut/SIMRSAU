<?php

namespace App;

use App\Tb_hasil;

use Illuminate\Database\Eloquent\Model;

class Tb_daftar extends Model
{
    protected $table = "tb_daftars";
    
    protected $dates = ['created_at', 'updated_at','tgl_kedatangan'];


    protected $fillable = [
      'user_id','no_rm','nama_pasien','nama_dokter','keluhan', 'tgl_kedatangan','statusdaftar'
    ];

    public function daftarpasiens()
    {
    	return $this->belongsTo('App\User');
    }


   public function hasilradiologi(){
   		return $this->has('App\Tb_hasil');
   }
}

