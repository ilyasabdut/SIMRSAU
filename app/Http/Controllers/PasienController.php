<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tb_biopasien;
use App\Tb_biodokter;
use App\Tb_daftar;
use DB;
use Auth;
use PDF;

class PasienController extends Controller
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
    public $id;
    public function index()
    {
        $this->id = Auth::user()->id;
         $pasiens = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_daftars', 'tb_user.id', '=', 'tb_daftars.user_id')
                 ->select('tb_daftars.*','tb_user.*','tb_biopasiens.*')
                 ->where('tb_user.id', '=', $this->id)
                 ->where(function($query){
                        $query->where('tb_user.status', '=', 'non-aktif')
                             ->orwhere('tb_user.status', '=', 'aktif')
                             ->orwhere('tb_user.status', '=', 'menunggu')
                             ->orwhere('tb_user.status', '=', 'Terkonfirmasi. Silahkan tunggu antrian')
                             ->orWhere('tb_user.status', '=', 'sedang dalam ruangan')
                             ->orwhere('tb_user.status','=', 'dirujuk ke radiologi')
                             ->orwhere('tb_user.status', '=', 'sedang dalam radiologi')
                             ->orwhere('tb_user.status', '=', 'selesai dari radiologi')
                             ->orwhere('tb_user.status', '=', 'Ditolak. Silahkan ulangi pendaftaran')
                             ->orwhere('tb_user.status','=','selesai');
                 })
                 ->get();

        $riwayat = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_hasils', 'tb_user.id', '=', 'tb_hasils.user_id')
                 ->where('tb_user.id', '=', $this->id)
                 ->where('tb_hasils.statusrm','=','selesai')
                 ->orderBy('tb_hasils.created_at','desc')
                 ->get();

        return view('pasien/dashboard')->with(['pasiens'=>$pasiens,'riwayat'=>$riwayat]);
        
    }

    public function daftar(){
       $this->id = Auth::user()->id;
       $data = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->select('tb_user.*','tb_biopasiens.*')
                ->where('tb_user.id', '=', $this->id)
                ->get();

        return view('pasien/daftar')->with(['data'=>$data]);
    }


        public function daftars(Request $req){

            $iddokter = DB::table('tb_user')
                        ->leftjoin('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                        ->select('tb_user.id')
                        ->where('tb_user.level', '=', 'dokter')
                        ->where('tb_biodokters.bidang', '=', 'Dokter Penyakit Dalam')
                        ->get();

                foreach ($iddokter as $iddaftar) {$iddokter = $iddaftar->id;}

            $ID = Auth::user()->id;
     

            $users = User::find($ID);
            $users->status = $req->input('status','menunggu');
            $users->save(); 

            $daftars = new Tb_daftar;
            $daftars->user_id = $req->input('user_id');
            $daftars->nama_pasien = $req->input('nama_pasien');
            $daftars->no_rm = $req->input('no_rm');
            $daftars->statusdaftar = $req->input('statusdaftar','non-aktif');
            $daftars->bidang = $req->input('bidang','penyakit dalam');
            $daftars->tgl_kedatangan = $req->input('tgl_kedatangan');
            $daftars->save();

             

            if(count($daftars) > 0){
                    return redirect('/pasien')
                    ->with('info','selesai mendaftar!');
                } else {
                    return view('/pasien');
                }
        }


     public function lihatrm($ID)
    {
        $rm =  DB::table('tb_hasils')
                 ->leftjoin('tb_user', 'tb_hasils.user_id', '=', 'tb_user.id')
                ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->select('tb_hasils.*','tb_user.*','tb_biopasiens.*','tb_hasils.updated_at as tgldtg')
                ->where('tb_hasils.id', '=', $ID)
                ->get();

        return view('dokter/lihatrm',['rm' => $rm]);
    }

    public function exportPDF($ID)
    {
        $rm =  DB::table('tb_hasils')
                 ->leftjoin('tb_user', 'tb_hasils.user_id', '=', 'tb_user.id')
                ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->select('tb_hasils.*','tb_user.*','tb_biopasiens.*','tb_hasils.updated_at as tgldtg')
                ->where('tb_hasils.id', '=', $ID)
                ->get();

            $pdf = PDF::loadView('pasien.pasienpdf', compact('rm'));
            return $pdf->download('rekam medis.pdf');
    }

   
}
