<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});


//==================================================Auth=============================================================
Route::get('auth/register', 'Auth\RegisterController@showRegister');
Route::post('auth/create', 'Auth\RegisterController@create')->name('create');

Route::get('auth/login', 'PublicController@showLogin');
Route::post('auth/login', 'Auth\LoginController@authenticate');

    Route::get('/logout', function(){
        Auth::logout();
        return redirect('/');
});


Auth::routes();


//==================================================Admin=============================================================




Route::group(['prefix' => 'admin' ,'middleware' =>'web'],function(){

    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/tambah', 'AdminController@tambah')->name('admin.tambah');
    Route::post('/insert', 'AdminController@insert')->name('admin.insert');



    Route::group(['prefix' => 'tenkes'],function(){

             Route::get('/', 'AdminController@tenkes')->name('admin.tenkes');
             Route::get('/tambah', 'AdminController@tenkestambah')->name('admin.tenkes.tambah');
             Route::post('/insert', 'AdminController@tenkesinsert')->name('admin.tenkes.insert');
             Route::get('/delete/{ID}', 'AdminController@tenkesdelete')->name('admin.tenkes.delete');
             Route::get('/update/{ID}', 'AdminController@tenkesupdate');
             Route::post('/edit/{ID}', 'AdminController@tenkesedit');
             Route::get('/read/{ID}', 'AdminController@tenkeslihat');
             Route::get('/importexport', 'AdminController@importexporttenkes')->name('admin.importexport');
             Route::get('/exporttenkes/{type}', 'AdminController@tenkesExport')->name('admin.exportdokter');
             Route::post('/importtenkes', 'AdminController@tenkesImport')->name('admin.importtenkes');
             Route::post('/importtenkes2', 'AdminController@tenkesImport2')->name('admin.importtenkes2');
             Route::post('/tenkesstatus/{ID}','AdminController@tenkesStatus')->name('admin.tenkesStatus');
             Route::post('/tenkesstatus2/{ID}','AdminController@tenkesStatus2')->name('admin.tenkesStatus2');

    });

    Route::group(['prefix' => 'pasien'],function(){

             Route::get('/', 'AdminController@pasien')->name('admin.pasien');
             Route::get('/tambah', 'AdminController@tambahpasien')->name('admin.pasien.tambah');
             Route::post('/insert', 'AdminController@insertpasien')->name('admin.pasien.insert');
             Route::get('/delete/{ID}', 'AdminController@pasiendelete')->name('admin.pasien.delete');
             Route::get('/update/{ID}', 'AdminController@pasienupdate');
             Route::post('/edit/{ID}', 'AdminController@pasienedit');
             Route::get('/read/{ID}', 'AdminController@pasienlihat');
             Route::get('/importexport', 'AdminController@importexportpasien')->name('admin.importexport');
             Route::get('/exportpasien/{type}', 'AdminController@pasienExport')->name('admin.exportpasien');
             Route::post('/importpasien', 'AdminController@pasienImport')->name('admin.importpasien');
             Route::post('/importpasien2', 'AdminController@pasienImport2')->name('admin.importpasien2');

    });

    Route::group(['prefix' => 'penyakit'],function(){

             Route::get('/', 'AdminController@penyakit')->name('admin.penyakit');
             Route::get('/tambah', 'AdminController@tambahpenyakit')->name('admin.penyakit.tambah');
             Route::post('/insert', 'AdminController@insertpenyakit')->name('admin.penyakit.insert');
             Route::get('/delete/{ID}', 'AdminController@penyakitdelete')->name('admin.penyakit.delete');
             Route::get('/update/{ID}', 'AdminController@penyakitupdate');
             Route::post('/edit/{ID}', 'AdminController@penyakitedit');
             Route::get('/read/{ID}', 'AdminController@penyakitlihat');
             Route::get('/importexport', 'AdminController@importexportpenyakit')->name('admin.importexport');
             Route::get('/exportpenyakit/{type}', 'AdminController@penyakitExport')->name('admin.exportpenyakit');
             Route::post('/importpenyakit', 'AdminController@penyakitImport')->name('admin.importpenyakit');
    });

    Route::group(['prefix' => 'obat'],function(){

             Route::get('/', 'AdminController@obat')->name('admin.obat');
             Route::get('/tambah', 'AdminController@tambahobat')->name('admin.obat.tambah');
             Route::post('/insert', 'AdminController@insertobat')->name('admin.obat.insert');
             Route::get('/delete/{ID}', 'AdminController@obatdelete')->name('admin.obat.delete');
             Route::get('/update/{ID}', 'AdminController@obatupdate');
             Route::post('/edit/{ID}', 'AdminController@obatedit');
             Route::get('/read/{ID}', 'AdminController@obatlihat');
             Route::get('/importexport', 'AdminController@importexportobat')->name('admin.importexport');
             Route::get('/exportobat/{type}', 'AdminController@obatExport')->name('admin.exportobat');
             Route::post('/importobat', 'AdminController@obatImport')->name('admin.importobat');
    });


});

//==================================================Pasien=============================================================

Route::group(['prefix' => 'pasien' ,'middleware' => 'web'],function(){

    Route::get('/', 'PasienController@index')->name('pasien.dashboard');
    Route::get('/riwayat', 'PasienController@riwayat')->name('pasien.riwayat');
    Route::get('/daftar', 'PasienController@daftar')->name('pasien.daftar');
    Route::post('/daftars', 'PasienController@daftars')->name('pasien.daftars');
    Route::get('/konfirmasi','PasienController@konfirmasi')->name('pasien.konfirmasi');
    Route::post('/konfirmasis','PasienController@konfirmasis')->name('pasien.konfirmasis');
    Route::get('/lihatrm/{ID}','PasienController@lihatrm')->name('pasien.lihatrm');
    Route::get('/lihatrm/PDF/{ID}', 'PasienController@exportPDF')->name('pasien.PDF');


});


//==================================================Dokter=============================================================

Route::group(['prefix' => 'dokter' ,'middleware' => ['auth']],function(){

    Route::get('/', 'DokterController@index')->name('dokter.dashboard');
    Route::get('/interview/{ID}', 'DokterController@interview')->name('dokter.interview');
    Route::post('/interviews/{ID}', 'DokterController@interviews')->name('dokter.interviews');
    Route::get('/suntingrm/{ID}','DokterController@suntingrm')->name('dokter.suntingrm');
    Route::post('/suntingrms/{ID}','DokterController@suntingrms')->name('dokter.suntingrms');
    Route::get('/riwayat', 'DokterController@riwayat')->name('dokter.riwayat');
    Route::get('/riwayattindakan/{ID}', 'DokterController@riwayattindakan')->name('dokter.riwayattindakan');
    Route::get('/riwayattindakan/PDF/{ID}', 'DokterController@exportPDF')->name('dokter.PDF');




});

//======================Tenaga Kesehatan=============================================================================

Route::group(['prefix' => 'tenkes' ,['middleware' =>['auth']]],function(){

    Route::get('/', 'TenkesController@index')->name('tenkes.dashboard');
    Route::post('/konfirmasi/{ID}', 'TenkesController@konfirmasi'); 
    Route::post('/tolak/{ID}', 'TenkesController@tolak'); 


});


Route::get('/home', 'HomeController@index')->name('home');
