<?php

namespace App\Http\Controllers;

use Input;
use Redirect;
use DB;
use Auth;
use Mail;

use Illuminate\Http\Request;

use App\Tb_penyakit;
use App\Tb_obat;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
	public function showLogin(){
        return view('auth.login');
    }

}