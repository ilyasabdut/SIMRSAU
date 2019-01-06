<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\User;
use App\Tb_biodokter;
use App\Tb_biopasien;
use App\Tb_penyakit;
use App\Tb_obat;
use Excel;
use Input;


class AdminController extends Controller
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
        
        return view('admin.dashboard');
        
    }

// =========================================================PASIEN=====================================================    

    public function pasien()
    {
         $data = DB::table('tb_user')
                 ->leftjoin('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->select('tb_user.*','tb_biopasiens.*')
                ->where('tb_user.level', '=', 'pasien')
                ->get();

        return view('admin.pasien.pasien',compact('data'));
    }
   
    public function importexportpasien(){
        return view('admin.pasien.importexport');
    }

    public function tambahpasien(){
        return view('admin.pasien.tambah');
    }

     public function insertpasien(Request $req){

        $this->validate($req, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
           
        ]);


        $users = new User;
        $users->nama = $req->input('nama');
        $users->email = $req->input('email');
        $users->password = bcrypt($req->input('password'));
        $users->level = $req->input('level','pasien');
        $users->status = $req->input('status','aktif');
        $users->save();

        $tbpasien = new Tb_biopasien;
        $tbpasien->no_rm = $req->input('no_rm');
        $tbpasien->NIK = $req->input('NIK');
        $tbpasien->jenis_kelamin = $req->input('jenis_kelamin');
        $tbpasien->tgl_lahir = $req->input('tgl_lahir');
        $tbpasien->gol_darah = $req->input('gol_darah');
        $tbpasien->no_telp = $req->input('no_telp');
        $tbpasien->alamat = $req->input('alamat');
    

        $users->tbpasien()->save($tbpasien);

          if(count($users) > 0){
                return redirect('/admin/pasien/')->with('info','Record Saved Successfully');
            } else {
                return view('admin/tambah');
            }
    
    }

    public function pasienupdate($ID){
        $data = DB::table('tb_user')
                 ->join('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->select('tb_user.*','tb_biopasiens.*')
                ->where('tb_user.id', '=', $ID)
                ->get();

        return view('admin/pasien/sunting',['data' => $data]);
    }

    public function pasienedit(Request $req, $ID){
         $this->validate($req, [
           'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
     

        $users = User::find($ID);
        $users->nama = $req->input('nama');
        $users->email = $req->input('email');
        $users->password = bcrypt($req->input('password'));
        $users->level = $req->input('level','pasien');
        $users->save();

        $tbpasien =Tb_biopasien::find($ID);
        $tbpasien->no_rm = $req->input('no_rm');
        $tbpasien->NIK = $req->input('NIK');
        $tbpasien->jenis_kelamin = $req->input('jenis_kelamin');
        $tbpasien->tgl_lahir = $req->input('tgl_lahir');
        $tbpasien->gol_darah = $req->input('gol_darah');
        $tbpasien->no_telp = $req->input('no_telp');
        $tbpasien->alamat = $req->input('alamat');
    

        $users->tbpasien()->save($tbpasien);

          if(count($users) > 0){
                return redirect('/admin/pasien/')->with('info','Record Updated Successfully');
            } else {
                return view('admin/pasien/sunting');
            }
    }


    public function pasienlihat($ID){
        $data = DB::table('tb_user')
                 ->join('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                 ->select('tb_user.*','tb_biopasiens.*')
                ->where('tb_user.id', '=', $ID)
                ->get();

        return view('admin/pasien/lihat',['data' => $data]);
    }


    public function pasiendelete($ID){
        $users = User::find($ID)->deletepas();

         if(count($ID) > 0){
                return redirect('/admin/pasien')->with('info','Record Deleted Successfully');
            } else {
                return view('admin/pasien')->with('info','Record not Deleted');;
            }
    }


  public function pasienExport($type)
    {
         $items = User::join('tb_biopasiens', 'tb_user.id', '=', 'tb_biopasiens.id')
                    ->select(
                        'tb_user.nama','tb_user.email','tb_user.level',
                        'tb_biopasiens.NIK','tb_biopasiens.no_rm','tb_user.status',
                        'tb_biopasiens.jenis_kelamin','tb_biopasiens.alamat',
                        'tb_biopasiens.no_telp','tb_biopasiens.gol_darah','tb_biopasiens.tgl_lahir'
                    )
                    ->where('tb_user.level','=','pasien')
                    ->get();

                    $itemsArray = []; 
                     foreach ($items as $item) {
                        $itemsArray[] = $item->toArray();
                    }   

                Excel::create('List Pasien', function($excel) use($itemsArray){
                $excel->sheet('Sheet 1', function($sheet) use($itemsArray){

                   $sheet->fromArray($itemsArray,null,'A1',false,false)->prependRow(array(
                        'Nama', 'Email', 'Level', 'NIK', 'Nomor Rekam Medis',
                        'Status', 'Jenis Kelamin','Alamat','Nomor Telepon','Golongan Darah','Tanggal Lahir'
                    ));
             });

            })->export($type);
    }

    public function pasienImport(Request $req)
    {
        $this->validate($req, ['import_file' => 'required|mimes:xls,xlsx,csv']);

        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {

            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'id' => $value->id,
                     'nama' => $value->nama,
                    'email' =>  $value->email,
                    'password' => bcrypt($value->password),
                    'level' => $value->level,    
                    'status' => $value->status
                ];
                }

                if(!empty($insert)){
                     DB::table('tb_user')->insert($insert);
                     return redirect('/admin/pasien/importexport')
                    ->with('info','Data otentifikasi berhasil diimpor');
                }
            }
        }
        return back();
    }

    public function pasienImport2(Request $req)
    {
        $this->validate($req, ['import_file2' => 'required|mimes:xls,xlsx,csv']);

        if(Input::hasFile('import_file2')){
            $path = Input::file('import_file2')->getRealPath();
            $data = Excel::load($path, function($reader) {

            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                    'id' => $value->id,
                    'nik' => $value->nik,
                    'no_rm' => $value->no_rm,
                    'no_telp' =>  $value->no_telp,
                    'jenis_kelamin' => $value->jenis_kelamin,
                    'alamat' => $value->alamat,
                    'gol_darah' => $value->gol_darah,
                    'tgl_lahir' => $value->tgl_lahir,                    
                ];
                }

                if(!empty($insert)){
                   Tb_biopasien::insert($insert);
                return redirect('/admin/pasien/importexport')
                ->with('info','Data Personal berhasil diimpor');
                }
            }
        }
        return back();
    }


// =====================================================Tenaga Kesehatan   ===================================
     public function tenkes()
    {
        $data = DB::table('tb_user')
                 ->leftjoin('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                 ->select('tb_user.*','tb_biodokters.*')
                ->where('tb_user.level', '=', 'perawat')
                ->orwhere('tb_user.level', '=', 'resepsionis')
                ->orwhere('tb_user.level','=','dokter')
                ->get();


        return view('admin.tenkes.tenkes',compact('data'));
    }

    public function tenkestambah(){
        return view('admin.tenkes.tambah');
    }

    public function tenkesinsert(Request $req){

        $this->validate($req, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
           
        ]);


        $users = new User;
        $users->nama = $req->input('nama');
        $users->email = $req->input('email');
        $users->password = bcrypt($req->input('password'));
        $users->level = $req->input('bidang');
        $users->status = $req->input('status','hadir');
        $users->save();

        $tbdokter =new Tb_biodokter;
        $tbdokter->kd_dokter = $req->input('kd_dokter');
        $tbdokter->NIK = $req->input('NIK');
        $tbdokter->bidang = $req->input('bidang');
        $tbdokter->pangkat = $req->input('pangkat');
        $users->tbdokter()->save($tbdokter);
        
          if(count($users) > 0){
                return redirect('/admin/tenkes')->with('info','Record Saved Successfully');
            } else {
                return view('admin/tenkes/tambah');
            }
    
    }

    public function tenkesupdate($ID){
        $data = DB::table('tb_user')
                 ->join('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                 ->select('tb_user.*','tb_biodokters.*')
                ->where('tb_user.id', '=', $ID)
                ->get();

        return view('admin/tenkes/sunting',['data' => $data]);
    }

    public function tenkesedit(Request $req,$ID){
         $this->validate($req, [
           'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $users = User::find($ID);
        $users->nama = $req->input('nama');
        $users->email = $req->input('email');
        $users->password = bcrypt($req->input('password'));
        $users->level = $req->input('level');
        $users->save();

        $tbdokter =Tb_biodokter::find($ID);
        $tbdokter->kd_dokter = $req->input('kd_dokter');
        $tbdokter->NIK = $req->input('NIK');
        $tbdokter->bidang = $req->input('bidang');
        $tbdokter->pangkat = $req->input('pangkat');

        $users->tbdokter()->save($tbdokter);

          if(count($users) > 0){
                return redirect('/admin/tenkes/')->with('info','Record Updated Successfully');
            } else {
                return view('admin/tenkes/sunting');
            }
    }

    public function tenkeslihat($ID){
                $data = DB::table('tb_user')
                 ->join('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                 ->select('tb_user.*','tb_biodokters.*')
                ->where('tb_user.id', '=', $ID)
                ->get();

        return view('admin/tenkes/lihat',['data' => $data]);
    }


    public function tenkesdelete($ID){
        $users = User::find($ID)->deletedok();

         if(count($ID) > 0){
                return redirect('/admin/tenkes')->with('info','Record Deleted Successfully');
            } else {
                return view('admin/tenkes')->with('info','Record not Deleted');;
            }
    }

     public function importexporttenkes(){
        return view('admin.tenkes.importexport');
    }

  public function tenkesExport($type)
    {
           
         $items = User::join('tb_biodokters', 'tb_user.id', '=', 'tb_biodokters.id')
                    ->select('tb_user.nama','tb_user.email','tb_user.level','tb_biodokters.NIK','tb_biodokters.kd_dokter','tb_biodokters.bidang','tb_biodokters.pangkat')
                    ->where('tb_user.level','=','dokter')
                    ->orwhere('tb_user.level','=','perawat')
                    ->orwhere('tb_user.level','=','resepsionis')
                    ->get();

                    $itemsArray = []; 
                     foreach ($items as $item) {
                        $itemsArray[] = $item->toArray();
                    }   

                Excel::create('List Dokter dan Tenaga Kesehatan', function($excel) use($itemsArray){
                $excel->sheet('Sheet 1', function($sheet) use($itemsArray){

                   $sheet->fromArray($itemsArray,null,'A1',false,false)->prependRow(array(
                        'Nama', 'Email', 'Level', 'NIK', 'Kode Dokter',
                        'Bidang', 'Pangkat'
                    ));

             });

            })->export($type);
    }

    public function tenkesImport(Request $req)
    {
        $this->validate($req, ['import_file' => 'required|mimes:xls,xlsx,csv']);

        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {

            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                     'id' => $value->id,  
                    'nama' => $value->nama,
                    'email' =>  $value->email,
                    'password' => bcrypt($value->password),
                    'level' => $value->level,    
                    'status' => $value->status,
                    ];                
                
                }

                if(!empty($insert)){
                     DB::table('tb_user')->insert($insert); 
                return redirect('/admin/tenkes/importexport')->with('info','Data Otentifikasi berhasil diimpor');
                }
            }
        }
        return back();
    }

     public function tenkesImport2(Request $req)
    {
        $this->validate($req, ['import_file2' => 'required|mimes:xls,xlsx,csv']);

        if(Input::hasFile('import_file2')){
            $path = Input::file('import_file2')->getRealPath();
            $data = Excel::load($path, function($reader) {

            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'id' => $value->id,
                    'bidang' => $value->bidang,    
                    'nik' => $value->nik,
                    'kd_dokter' => $value->kd_dokter,
                    'pangkat' => $value->pangkat,
                    ];                
                }

                if(!empty($insert)){
                     Tb_biodokter::insert($insert); 
                return redirect('/admin/tenkes/importexport')->with('info','Data Personal berhasil diimpor');
                }
            }
        }
        return back();
    }

    public function tenkesStatus(Request $req,$ID){

         $tenkesStatus = User::find($ID);
            $tenkesStatus->status = $req->input('status','tidak hadir');
            $tenkesStatus->save();


              if(count($tenkesStatus) > 0){
                    return redirect('admin/tenkes')->with('info','Status Diubah Menjadi Tidak Hadir');
                } else {
                    return view('admin/tenkes');
                }
    }

    public function tenkesStatus2(Request $req,$ID){
    
         $tenkesStatus = User::find($ID);
            $tenkesStatus->status = $req->input('status','hadir');
            $tenkesStatus->save();


              if(count($tenkesStatus) > 0){
                    return redirect('admin/tenkes')->with('info','Status Diubah Menjadi Hadir');
                } else {
                    return view('admin/tenkes');
                }
    }
//=====================================Penyakit=========================================================
    public function penyakit()
    {
        $data = Tb_penyakit::all();

        return view('admin.penyakit.penyakit',compact('data'));
    }

     public function tambahpenyakit(){
        return view('admin.penyakit.tambah');
    }

     public function insertpenyakit(Request $req){

        $this->validate($req, [
            'nama_penyakit' => 'required',
            'kd_penyakit' => 'required',
           
        ]);


        $data = new Tb_penyakit;
        $data->nama_penyakit = $req->input('nama_penyakit');
        $data->kd_penyakit = $req->input('kd_penyakit');
        $data->save();

          if(count($data) > 0){
                return redirect('/admin/penyakit/')->with('info','Record Saved Successfully');
            } else {
                return view('admin/tambah');
            }
    
    }


    public function penyakitupdate($ID){
         $data = Tb_penyakit::find($ID);


        return view('admin/penyakit/sunting',['data' => $data]);
    }

    public function penyakitedit(Request $req,$ID){
         $this->validate($req, [
           'nama_penyakit' => 'required',
            'kd_penyakit' => 'required',
        ]);

        $data = Tb_penyakit::find($ID);
        $data->nama_penyakit = $req->input('nama_penyakit');
        $data->kd_penyakit = $req->input('kd_penyakit');
        $data->save();

          if(count($data) > 0){
                return redirect('/admin/penyakit/')->with('info','Record Updated Successfully');
            } else {
                return view('admin/penyakit/sunting');
            }
    }

    public function penyakitlihat($ID){
         $data = Tb_penyakit::find($ID);

        return view('admin/penyakit/lihat',['data' => $data]);
    }


    public function penyakitdelete($ID){
        Tb_penyakit::where('ID', $ID)->delete();

         if(count($ID) > 0){
                return redirect('/admin/penyakit')->with('info','Record Deleted Successfully');
            } else {
                return view('admin/penyakit')->with('info','Record not Deleted');;
            }
    }

    public function importexportpenyakit(){
        return view('admin.penyakit.importexport');
    }

  public function penyakitExport($type)
    {
           
        $data = Dokter::get()->toArray();

                Excel::create('List Penyakit', function($excel) use($itemsArray){
                $excel->sheet('Sheet 1', function($sheet) use($itemsArray){

                   $sheet->fromArray($itemsArray,null,'A1',false,false)->prependRow(array(
                        'Nama Penyakit', 'Kode Penyakit'
                    ));

             });

            })->export($type);
    }

    public function penyakitImport(Request $req)
    {
        $this->validate($req, ['import_file' => 'required|mimes:xls,xlsx,csv']);

        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {

            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                       
                    'nama_penyakit' => $value->nama_penyakit,
                    'kd_penyakit' =>  $value->kd_penyakit,    
                    ];                
                
                
                }

                if(!empty($insert)){
                     DB::table('tb_penyakits')->insert($insert);

                return redirect('/admin/penyakit')->with('info','Record Uploaded Successfully');
                }
            }
        }
        return back();
    }

//=====================================================Obat===============================================
     public function obat()
    {
        $data = Tb_obat::all();

        return view('admin.obat.obat',compact('data'));
    }

     public function tambahobat(){
        return view('admin.obat.tambah');
    }

     public function insertobat(Request $req){

        $this->validate($req, [
            'nama_obat' => 'required',
            'kd_obat' => 'required',
           
        ]);


        $data = new Tb_obat;
        $data->nama_obat = $req->input('nama_obat');
        $data->kd_obat = $req->input('kd_obat');
        $data->save();

          if(count($data) > 0){
                return redirect('/admin/obat/')->with('info','Record Saved Successfully');
            } else {
                return view('admin/tambah');
            }
    
    }


    public function obatupdate($ID){
         $data = Tb_obat::find($ID);


        return view('admin/obat/sunting',['data' => $data]);
    }

    public function obatedit(Request $req,$ID){
         $this->validate($req, [
           'nama_obat' => 'required',
            'kd_obat' => 'required',
        ]);

        $data = Tb_obat::find($ID);
        $data->nama_obat = $req->input('nama_obat','ABBOCATH 1801');
        $data->kd_obat = $req->input('kd_obat');
        $data->save();

          if(count($data) > 0){
                return redirect('/admin/obat/')->with('info','Record Updated Successfully');
            } else {
                return view('admin/obat/sunting');
            }
    }

    public function obatlihat($ID){
         $data = Tb_obat::find($ID);

        return view('admin/obat/lihat',['data' => $data]);
    }


    public function obatdelete($ID){
        Tb_obat::where('ID', $ID)->delete();

         if(count($ID) > 0){
                return redirect('/admin/obat')->with('info','Record Deleted Successfully');
            } else {
                return view('admin/obat')->with('info','Record not Deleted');;
            }
    }

    public function importexportobat(){
        return view('admin.obat.importexport');
    }

  public function obatExport($type)
    {
           
        $data = Dokter::get()->toArray();

                Excel::create('List obat', function($excel) use($itemsArray){
                $excel->sheet('Sheet 1', function($sheet) use($itemsArray){

                   $sheet->fromArray($itemsArray,null,'A1',false,false)->prependRow(array(
                        'Nama obat', 'Kode obat'
                    ));

             });

            })->export($type);
    }

    public function obatImport(Request $req)
    {
        $this->validate($req, ['import_file' => 'required|mimes:xls,xlsx,csv']);

        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {

            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                       
                    'nama_obat' => $value->nama_obat,
                    'kd_obat' =>  $value->kd_obat,    
                    ];                
                
                
                }

                if(!empty($insert)){
                     DB::table('tb_obats')->insert($insert);

                return redirect('/admin/obat')->with('info','Record Uploaded Successfully');
                }
            }
        }
        return back();
    }


}
