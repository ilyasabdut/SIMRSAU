@include('inc.headerauth')
  <meta http-equiv="refresh" content="60" />
     <title>{{ env('APP_NAME') }} - Halaman Utama</title> 
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Halaman Utama Resepsionis
        </li>
      </ol>
       @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif

   <div class="row">      
<div class="col-sm-4">  
              <div class="card text-white bg-primary o-hidden mb-3">
              <div class="card-header">
                  Otomatis Memuat Halaman:
              </div>

              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa-fw fa fa-hourglass-start  "></i>
                </div>
                <div class="mr-5"> 
                   <h2 style="text-align: center;"> 
                      <span id="countdown"> </span> 
                       </h2>
                </div>  
              </div>
            </div>
          </div>

        <div class="col-sm-4">
            <div class="card text-white bg-primary o-hidden mb-3">
            <div class="card-header">
                Jumlah pasien dikonfirmasi :
            </div>

            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa-fw fa fa-hourglass-start  "></i>
              </div>
           
              <div class="mr-5"> 
                  <h2 style="text-align: center;"> 
                      {{ count(DB::table('tb_daftars')
                              ->whereDate('created_at','=', Carbon::today()->toDateString())
                              ->where(function($query){
                                  $query->where('statusdaftar','=','aktif')
                                         ->orwhere('statusdaftar','=','dirujuk ke radiologi')
                                        ->orwhere('statusdaftar','=','sedang dalam radiologi')
                                         ->orwhere('statusdaftar','=','selesai dari radiologi')
                                         ->orwhere('statusdaftar','=','selesai'); 
                                         })                             
                                     ->get())
                      }}                     
                 </h2>
              </div>  
            </div>
          </div>
        </div>

        <div class="col-sm-4">

          <div class="card text-white bg-primary o-hidden mb-3">
            <div class="card-header">
              Jumlah pasien ditolak :
            </div>
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-info"></i>
              </div>

              <div class="mr-5"> 

                    <h2 style="text-align: center;"> 
                      {{ count(DB::table('tb_daftars')
                              ->whereDate('created_at','=', Carbon::today())
                              ->where('statusdaftar','=','ditolak')
                              ->get())}}
                     </h2>
               

              </div>  
            </div>
          </div>
        </div>
      </div>
           
            

  <div class="row">
   <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Pasien 
        </div>
        <div class="card-body">
           <div class="table-responsive">
            <table class="table table-bordered" id="resepsionis" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tanggal Kedatangan</th>
                  <th>Nama </th>
                  <th>Nomor Rekam Medis</th>
                  <th>NIK</th>
                  <th>Poliklinik</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
               @if(count($data)>0)
                 @foreach ($data as $dat)
              <tr>
                @if($dat->statusdaftar == 'non-aktif')
                <td>{{$dat->tgl_kedatangan}}</td>
                <td>{{$dat->nama}}</td>
                <td>{{$dat->no_rm}}</td>
                <td>{{$dat->NIK}}</td>
                <td>{{$dat->bidang}}</td>
                <td>
          <div class="btn-group">

            <form action="{{url('/tenkes/konfirmasi',array($dat->id))}}" method="POST">
              @csrf
                  <button type="submit"  class="btn btn-sm btn-primary" title="konfirmasi" aria-label="konfirmasi">
                            <i class="fa fa-check" aria-hidden="true"></i>  
                 </button>  
          </form>
          <form action="{{url('/tenkes/tolak',array($dat->id))}}" method="POST">
            @csrf
                   <button type="submit" class="btn btn-sm btn-danger" title="ditolak" aria-label="ditolak">
                              <i class="fa fa-times" aria-hidden="true"></i> 
                     </button>
           </form>
              </div>

                </td>
              @endif
            </tr>
               @endforeach
            @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<script>
          var param = 60; 
          var today = new Date();
          var newDate = today.setSeconds(today.getSeconds() + param);
          $('#countdown').countdown(newDate, function(event) {
            $(this).html(event.strftime('%S'));
          });
          </script>

  @include('inc.footerauth')

  
   
