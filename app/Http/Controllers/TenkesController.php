<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tb_biopasien;
use App\Tb_daftar;
use Carbon;
use Auth;
use DB;
use Excel;
use Input;


class TenkesController extends Controller
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

    public function index(){
       if(Auth::user()->level == 'resepsionis'){
         $data = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_daftars', 'tb_user.id', '=', 'tb_daftars.user_id')
                 ->select('tb_user.*','tb_biopasiens.*','tb_daftars.*')
                 ->where('tb_daftars.statusdaftar', '=', 'non-aktif')
                 ->get();

            return view('resepsionis.dashboard',compact('data'));


        }

        elseif(Auth::user()->level == 'perawat'){

          $this->id = Auth::user()->id;

        $perawats = DB::table('tb_user')
                    ->leftjoin('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                 ->select('tb_user.*','tb_biodokters.*')
                 ->where('tb_user.id', '=', $this->id)
                 ->get();

            $data = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_daftars', 'tb_user.id', '=', 'tb_daftars.user_id')
                 ->select('tb_user.*','tb_biopasiens.*','tb_daftars.*')
                ->where(['tb_user.status' => 'Terkonfirmasi. Silahkan tunggu antrian','tb_daftars.statusdaftar' => 'aktif'])
                ->orwhere(['tb_user.status' => 'dirujuk ke radiologi','tb_daftars.statusdaftar' => 'dirujuk ke radiologi'])
                ->get();

            return view('perawat.dashboard')->with(['perawats'=>$perawats,
                                             'data'=>$data,
                                         ]);;
        }
     }

    public $reseps;
    public $antri;
    public function konfirmasi(Request $req, $ID){
         if(Auth::user()->level == 'resepsionis'){

            $this->reseps = Auth::user()->id; 

            

             $userid = DB::table('tb_daftars')
                        ->select('tb_daftars.user_id')
                        ->where('tb_daftars.statusdaftar','=', 'non-aktif')
                        ->where('tb_daftars.id','=',$ID)
                        ->get();

            foreach ($userid as $useriddaftar) {$userid = $useriddaftar->user_id;}


            $tbdaftar = DB::table('tb_user')
                        ->leftjoin('tb_daftars','tb_user.id','=','tb_daftars.user_id')
                        ->where('tb_daftars.id',$ID)
                        ->where('tb_daftars.statusdaftar', 'non-aktif');

            $tbdaftar->update(['tb_daftars.updated_at' => Carbon::now()->toDateTimeString()]);
            $tbdaftar->update(['statusdaftar' => 'aktif']);

            $this->antri = DB::table('tb_daftars')
                              ->whereDate('created_at','=', Carbon::today()->toDateString())
                              ->where(function($query){
                                  $query->where('statusdaftar','=','aktif')
                                         ->orwhere('statusdaftar','=','dirujuk ke radiologi')
                                        ->orwhere('statusdaftar','=','sedang dalam radiologi')
                                         ->orwhere('statusdaftar','=','selesai dari radiologi')
                                         ->orwhere('statusdaftar','=','selesai'); 
                                         })                             
                                     ->count();

            $tbantriresepsionis = User::find($this->reseps);
            $tbantriresepsionis->antrian = $req->input('antrian',$this->antri);
            $tbantriresepsionis->save(); 

            $tbdaftarpasien = User::find($userid);
            $tbdaftarpasien->status = $req->input('status','Terkonfirmasi. Silahkan tunggu antrian');
            $tbdaftarpasien->antrian = $req->input('antrian', $this->antri);
            $tbdaftarpasien->save(); 

                           
                 if(count($tbdaftarpasien) > 0){
                        return redirect('/tenkes')->with('info','Pasien dikonfirmasi!');
                    } else {
                        return view('/tenkes');
                    }
                }

        elseif(Auth::user()->level == 'perawat'){

           

                 $userid = DB::table('tb_daftars')
                        ->select('tb_daftars.user_id')
                        ->where('tb_daftars.id','=',$ID)
                        ->get();

            foreach ($userid as $useriddaftar) {$userid = $useriddaftar->user_id;}

              $tbstatusdaftar = DB::table('tb_user')
                        ->leftjoin('tb_daftars','tb_user.id','=','tb_daftars.user_id')
                        ->where('tb_daftars.id',$ID);

            
                $tbhasilpasien = User::find($userid);
                    if($tbhasilpasien->status == 'Terkonfirmasi. Silahkan tunggu antrian'){
                        $tbhasilpasien->status = $req->input('status','sedang dalam ruangan');
                        $tbhasilpasien->save();
                    }
                    elseif($tbhasilpasien->status == 'dirujuk ke radiologi'){
                        $tbhasilpasien->status = $req->input('status','sedang dalam radiologi');
                        $tbhasilpasien->save();
                        $tbstatusdaftar->update(['statusdaftar' => 'sedang dalam radiologi']);

                    }

             if(count($tbhasilpasien) > 0){
                    return redirect('/tenkes')->with('info','Pasien dikonfirmasi!');
                } else {
                    return view('/tenkes');
                }
        }

       
    }

    public function tolak(Request $req,$ID){

         
            $tbdaftar = DB::table('tb_user')
                        ->leftjoin('tb_daftars','tb_user.id','=','tb_daftars.user_id')
                        ->where('tb_daftars.id',$ID);
                        
            $tbdaftar->update(['status' => 'Ditolak. Silahkan ulangi pendaftaran']);

            $tbdaftar = Tb_daftar::find($ID);
            $tbdaftar->statusdaftar = $req->input('statusdaftar','ditolak');
            $tbdaftar->save();


              if(count($tbdaftar) > 0){
                    return redirect('/tenkes')->with('info','Pasien ditolak!');
                } else {
                    return view('/tenkes');
                }
    }




  

}
