<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tb_biopasien extends Model
{
	protected $table ="tb_biopasiens";

	protected $fillable = ['NIK','No_rm','Gol_darah','Jenis_kelamin','Alamat','No_telp','tgl_lahir','id'];

       	protected $dates =  ['tgl_lahir'];
	public $timestamps = false;


    public function pasiens()
    {
    	return $this->belongsTo("App\User");
    }


    

}
