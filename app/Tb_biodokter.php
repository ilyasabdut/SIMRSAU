<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_biodokter extends Model
{
   protected $table = "tb_biodokters";


 protected $fillable = ['id','NIK','kd_dokter','pangkat','bidang'];
          public $timestamps = false;

  public function dokters()
    {
    	return $this->belongsTo("App\User");
    }
}
