<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tb_hasil;
use App\Tb_daftar;
use App\Tb_biopasien;
use DB;
use Auth;
use Excel;
use Input;
use PDF;


class DokterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        $this->id = Auth::user()->id;
        $this->nama = Auth::user()->nama;


        $dokter = DB::table('tb_user')
                    ->leftjoin('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                 ->select('tb_user.*','tb_biodokters.*')
                 ->where('tb_user.id', '=', $this->id)
                 ->get();


        $datapenyakitdalam = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_daftars', 'tb_user.id', '=', 'tb_daftars.user_id')
                 ->select('tb_user.*','tb_biopasiens.*','tb_daftars.*')
                ->where(function ($query) {
                        $query->where('tb_user.status','=','sedang dalam ruangan')
                            ->where('tb_daftars.statusdaftar', '=', 'aktif');
                    })->get();

        $datapostradio = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_hasils', 'tb_user.id', '=', 'tb_hasils.user_id')
                 ->select('tb_user.*','tb_biopasiens.*','tb_hasils.*')
                 ->where('tb_hasils.nama_dokter','=', $this->nama)
                 ->Where(function($query) {
                        $query->where('tb_user.status','=','selesai dari radiologi')
                            ->where('tb_hasils.statusrm', '=', 'selesai dari radiologi');   
                    })->get();

        $dataradiologi = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_daftars', 'tb_user.id', '=', 'tb_daftars.user_id')
                 ->select('tb_user.*','tb_biopasiens.*','tb_daftars.*')
                 ->where(function ($query) {
                        $query->where('tb_user.status','=','sedang dalam radiologi')
                            ->where('tb_daftars.statusdaftar', '=', 'sedang dalam radiologi');})
                ->get();
            

        return view('dokter.dashboard')->with(['dokter'=>$dokter,
                                             'datapenyakitdalam'=>$datapenyakitdalam,
                                             'dataradiologi'=>$dataradiologi,
                                             'datapostradio'=>$datapostradio
                                         ]); 
    }


    public function interview($ID)
    {    
         $this->id = Auth::user()->id;
         $dokters = DB::table('tb_user')
                ->leftjoin('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                ->select('tb_user.*','tb_biodokters.*')
                ->where('tb_user.id', '=', $this->id)
                ->get();



     foreach($dokters as $dokter){
      if($dokter->bidang == 'Dokter Penyakit Dalam'){
         $data = DB::table('tb_user')
                 ->leftjoin('tb_daftars', 'tb_user.id', '=', 'tb_daftars.user_id')
                 ->select('tb_user.*','tb_daftars.*')
                 ->where('tb_user.id', '=', $ID)
                 ->where(function ($query) {
                        $query->where('tb_daftars.statusdaftar', '=', 'aktif')
                                ->orwhere('tb_daftars.statusdaftar','=','selesai dari radiologi');
                            })
                ->get();
      

        $namaperawats = DB::table('tb_user')
                 ->leftjoin('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                 ->select('tb_user.*','tb_biodokters.*')
                ->where('tb_user.level', '=', 'perawat')
                ->orderBy('tb_user.nama','asc')
                ->get();

        $namapenyakits = DB::table('tb_penyakits')->orderBy('nama_penyakit','asc')->get();
        $namaobats = DB::table('tb_obats')->orderBy('nama_obat','asc')->get();


        return view('dokter.interview')->with(['data'=>$data,
                                             'namapenyakits'=>$namapenyakits,
                                             'namaperawats'=>$namaperawats,
                                             'namaobats'=>$namaobats
                                         ]);  
       


      }
      elseif($dokter->bidang == 'Dokter Radiologi'){
        
         $data = DB::table('tb_user')
                 ->leftjoin('tb_daftars', 'tb_user.id', '=', 'tb_daftars.user_id')
                 ->select('tb_user.*','tb_daftars.*')
                 ->where('tb_user.id', '=', $ID)
                 ->where('tb_daftars.statusdaftar','=','sedang dalam radiologi')
                ->get();
      
        return view('dokter.interview')->with(['data'=>$data]);  
           
      }
     }
    }


    public function interviews(Request $req, $ID){
    
     $this->id = Auth::user()->id;
     $dokters = DB::table('tb_user')
                ->leftjoin('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                ->select('tb_user.*','tb_biodokters.*')
                ->where('tb_user.id', '=', $this->id)
                ->get();



     foreach($dokters as $dokter){
      if($dokter->bidang == 'Dokter Penyakit Dalam'){

         $iduser = DB::table('tb_daftars')
            ->select('tb_daftars.id')
            ->where('tb_daftars.user_id','=',$ID)
            ->get();

        foreach ($iduser as $iddaftar) {
            $iduser = $iddaftar->id;
        }


         $users = User::find($ID);
         $users->status = $req->input('status');
         $users->save();
         $status = $users->status;


         $daftar = Tb_daftar::find($iduser);
         $daftar->statusdaftar = $req->input('statusdaftar',$status);
         $daftar->save();

        $hasils = new Tb_hasil;
        $hasils->user_id = $req->input('user_id');
        $hasils->nama_pasien = $req->input('nama_pasien');
        $hasils->no_rm = $req->input('no_rm');
        $hasils->nama_dokter = $req->input('nama_dokter');
        $hasils->nama_pasien = $req->input('nama_pasien');
        $hasils->nama_perawat = $req->input('nama_perawat');
        $hasils->nama_penyakit = $req->input('nama_penyakit');
        $hasils->nama_obat = implode(',', $req->nama_obat);
        $hasils->statusrm = $req->input('statusrm',$status);
        $hasils->keluhan = $req->input('keluhan');
        $hasils->catatan_dokter = $req->input('catatan_dokter');
        $hasils->save();


      }
      elseif($dokter->bidang == 'Dokter Radiologi'){

             $iddaftarradiologi = DB::table('tb_daftars')
                ->select('tb_daftars.id')
                ->where('tb_daftars.user_id','=',$ID)
                ->where('tb_daftars.statusdaftar','=','sedang dalam radiologi')
                ->get();

            foreach ($iddaftarradiologi as $iddaftar) {
                $iddaftarradiologi = $iddaftar->id;
            }

            $idhasilradiologi = DB::table('tb_hasils')
                ->select('tb_hasils.id')
                ->where('tb_hasils.user_id','=',$ID)
                ->where('tb_hasils.statusrm','=','dirujuk ke radiologi')
                ->get();

            foreach ($idhasilradiologi as $idhasil) {
                $idhasilradiologi = $idhasil->id;
            }



         $hasils = User::find($ID);
         $hasils->status = $req->input('status');
         $status = $hasils->status;
         $hasils->save();

         $daftarradiologi = Tb_daftar::find($iddaftarradiologi);
         $daftarradiologi->statusdaftar = $req->input('statusdaftar',$status);
         $daftarradiologi->save();


         $hasilradiologi = Tb_hasil::find($idhasilradiologi);
         $hasilradiologi->statusrm = $req->input('statusrm',$status);
         $hasilradiologi->save();
      }
     }


         if(count($hasils) > 0){
                return redirect('/dokter')->with('info','Pasien Selesai di Interview');
            } else {
                return view('/dokter');
            }
    }   

   

    public function suntingrm($ID){
        $data =  DB::table('tb_user')
                 ->leftjoin('tb_hasils', 'tb_user.id', '=', 'tb_hasils.user_id')
                 ->select('tb_user.nama','tb_hasils.*')
                ->where('tb_user.id', '=', $ID)
                ->where('tb_hasils.statusrm','=','selesai dari radiologi')
                ->get();


        return view('dokter.suntingrm')->with(['data'=>$data]);  
    }

    public function suntingrms(Request $req,$ID){



         $users = User::find($ID);
         $users->status = $req->input('status');
         $status = $users->status;
         $users->tbdaftar()->update(['statusdaftar' => $status]);
         $users->save();

         $iduser = DB::table('tb_hasils')
            ->select('tb_hasils.id')
            ->where('tb_hasils.user_id','=',$ID)
            ->get();

        foreach ($iduser as $idhasil) {
            $iduser = $idhasil->id;
        }


        $users = Tb_hasil::find($iduser);
        $users->nama_pasien = $req->input('nama_pasien');
        $users->no_rm = $req->input('no_rm');
        $users->nama_dokter = $req->input('nama_dokter');
        $users->nama_pasien = $req->input('nama_pasien');
        $users->nama_perawat = $req->input('nama_perawat');
        $users->nama_penyakit = $req->input('nama_penyakit');
        $users->nama_obat = $req->input('nama_obat');
        $users->catatan_dokter = $req->input('catatan_dokter');
        $users->statusrm = $req->input('statusrm',$status);
        $users->save();


        


         if(count($users) > 0){
                return redirect('/dokter')->with('info','Rekam medis berhasil disunting');
            } else {
                return view('/dokter');
            }
    }

    public function riwayat(){
         if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat'){
        
         $sub = Tb_hasil::orderBy('created_at','desc');


         $data = DB::table(DB::raw("({$sub->toSql()}) as sub"))
                 ->select('*')
                 ->where('statusrm','=','selesai')
                 ->get()
                 ->unique('user_id');

        }
         elseif(Auth::user()->level == 'resepsionis'){
         $sub = Tb_daftar::orderBy('created_at','desc');


         $data = DB::table(DB::raw("({$sub->toSql()}) as sub"))
                 ->select('*')
                 ->where('statusdaftar','=','aktif')
                 ->orwhere('statusdaftar','=','selesai')
                 ->get()
                 ->unique('user_id');

        }

            return view('dokter.riwayat')->with(['data'=>$data]);
         
    }

     public function riwayattindakan($ID){
         if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat'){
         $data = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_hasils', 'tb_biopasiens.id', '=', 'tb_hasils.user_id')
                 ->select('tb_user.*','tb_biopasiens.*','tb_hasils.*')
                 ->where('tb_user.id', '=', $ID)
                 ->orwhere('tb_user.status','=','selesai dari radiologi')
                 ->where('tb_hasils.statusrm', '=', 'selesai')
                ->get();

        }
         elseif(Auth::user()->level == 'resepsionis'){
         $data = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                ->leftjoin('tb_daftars', 'tb_biopasiens.id', '=', 'tb_daftars.user_id')
                 ->select('tb_user.*','tb_biopasiens.*','tb_daftars.*')
                 ->where('tb_user.id','=',$ID)
                ->where('tb_daftars.statusdaftar', '=', 'selesai')
                ->orwhere('tb_daftars.statusdaftar', '=', 'aktif')
                ->get();

        }
        $profile = DB::table('tb_biopasiens')
                 ->leftjoin('tb_daftars', 'tb_biopasiens.id', '=', 'tb_daftars.user_id')
                 ->select('tb_biopasiens.*','tb_daftars.*')
                 ->where('tb_daftars.user_id', '=', $ID)
                ->take(1)->get();
                
            return view('dokter.riwayattindakan')->with(['data'=>$data,'profile'=>$profile]);;
         
    }

  public function exportPDF($ID)
  {
    // Fetch all customers from database
    $profile = DB::table('tb_biopasiens')
                ->leftjoin('tb_daftars', 'tb_biopasiens.id', '=', 'tb_daftars.user_id')
                ->select('tb_biopasiens.*','tb_daftars.*')
                ->where('tb_daftars.user_id', '=', $ID)
                ->take(1)->get();

    $data = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->leftjoin('tb_hasils', 'tb_biopasiens.id', '=', 'tb_hasils.user_id')
                 ->select('tb_user.*','tb_biopasiens.*','tb_hasils.*')
                 ->where('tb_user.id', '=', $ID)
                 ->orwhere('tb_user.status','=','selesai dari radiologi')
                 ->where('tb_hasils.statusrm', '=', 'selesai')
                ->get();


    // Send data to the view using loadView function of PDF facade
    $pdf = PDF::loadView('dokter.dokterpdf', compact('data','profile'));
    return $pdf->download('riwayat tindakan.pdf');
  }

}
