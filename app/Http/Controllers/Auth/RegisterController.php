<?php

namespace App\Http\Controllers\Auth;

use App\Tb_biopasien;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/auth/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tb_users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public $no_rm;
    public function create(Request $req){

        $this->validate($req, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
           
        ]);

        $jumlah = User::where('level', 'pasien')->count() + 1;


        $nomor = str_pad($jumlah, 4, "0", STR_PAD_LEFT);        
        $this->no_rm = "P" . $nomor;

        $users = new User;
        $users->nama = $req->input('nama');
        $users->email = $req->input('email');
        $users->password = bcrypt($req->input('password'));
        $users->level = $req->input('level','pasien');
        $users->status = $req->input('status','aktif');
        $users->save();

        $tbpasien = new Tb_biopasien;
        $tbpasien->no_rm = $req->input('no_rm',$this->no_rm);
        $tbpasien->NIK = $req->input('NIK');
        $tbpasien->jenis_kelamin = $req->input('jenis_kelamin');
        $tbpasien->tgl_lahir = $req->input('tgl_lahir');
        $tbpasien->gol_darah = $req->input('gol_darah');
        $tbpasien->no_telp = $req->input('no_telp');
        $tbpasien->alamat = $req->input('alamat');
    
        $users->tbpasien()->save($tbpasien);

        if(count($users) > 0){
            return redirect('/login')
            ->with('info','Registrasi Berhasil,Silahkan Login!');
            } else {
                return view('register');
            }
    }



    public function showRegister(){
        return view('auth.register');
    }
}