<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->level == 'superadmin'){
         echo '<meta http-equiv="refresh" content="3;url=https://rsau.lala/admin" />';
        }
        elseif(Auth::user()->level == 'dokter'){
         echo '<meta http-equiv="refresh" content="3;url=https://rsau.lala/dokter" />';
        }
        elseif(Auth::user()->level == 'pasien'){
         echo '<meta http-equiv="refresh" content="3;url=https://rsau.lala/pasien" />';

        }
        elseif(Auth::user()->level == 'resepsionis'){
         echo '<meta http-equiv="refresh" content="3;url=https://rsau.lala/tenkes" />';
        }
        elseif(Auth::user()->level == 'perawat'){
         echo '<meta http-equiv="refresh" content="3;url=https://rsau.lala/tenkes" />';
        }


        return view('home');
    }   
}
