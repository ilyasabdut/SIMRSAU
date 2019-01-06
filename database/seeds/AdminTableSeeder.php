<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
	    $admin->name = 'superadmin';
	    $admin->email = 'superadmin@gmail.com';
	    $admin->password = bcrypt('superadmin');
	    $admin->save();

	}
}
