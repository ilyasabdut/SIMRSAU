<?php

use Illuminate\Database\Seeder;
use App\tb_users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tb_users = new tb_users();
	    $tb_users->nama = 'superadmin';
	    $tb_users->email = 'superadmin@gmail.com';
	    $tb_users->password = bcrypt('superadmin');
        $tb_users->level = 'superadmin';
	    $tb_users->save();  

        $tb_users = new tb_users();
        $tb_users->nama = 'dokternih';
        $tb_users->email = 'dokternih@gmail.com';
        $tb_users->password = bcrypt('dokternih');
        $tb_users->level = 'dokter';
        $tb_users->save();  
    }
}
