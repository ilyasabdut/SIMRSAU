<?php

use Illuminate\Database\Seeder;
use App\Dokter;


class DokterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dokter = new Dokter();
	    $dokter->name = 'salsabilla nadia isma';
	    $dokter->email = 'salsabillani@gmail.com';
	    $dokter->password = bcrypt('salsabillani');
	    $dokter->save();    
	}
}
