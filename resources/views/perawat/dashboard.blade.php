@include('inc.headerauth')

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
         <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('tenkes.dashboard')}}">Halaman Utama</a>
        </li>
        <li class="breadcrumb-item active">{{ Auth::user()->level }}</li>
      </ol>
  @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif
                  
     <title>{{ env('APP_NAME') }} - Halaman Utama</title> 
  <meta http-equiv="refresh" content="60" />

 <div class="row">      
  <div class="col-sm-4">  
              <div class="card text-white bg-primary o-hidden mb-3">
              <div class="card-header">
                  Memuat Halaman Otomatis:
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
  @if(count($perawats)>0)
              @foreach($perawats as $perawat)
                @if($perawat->bidang == 'perawat penyakit dalam')
        
        

        <div class="col-sm-4">  
              <div class="card text-white bg-primary o-hidden mb-3">
              <div class="card-header">
                  Pasien Belum di Periksa:
              </div>

              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa-fw fa fa-hourglass-start  "></i>
                </div>
                <div class="mr-5"> 
                   <h2 style="text-align: center;"> 
                        {{ count(DB::table('tb_daftars')
                                ->whereDate('created_at','=', Carbon::today()->toDateString())
                                ->where(function ($query) {
                                    $query ->where('statusdaftar','=','aktif')
                                           ->orwhere('statusdaftar','=','selesai dari radiologi');
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
                  Pasien Telah di Periksa :
              </div>

              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa-fw fa fa-hourglass-start  "></i>
                </div>
             
                <div class="mr-5"> 
                    <h2 style="text-align: center;"> 
                              {{ count(DB::table('tb_hasils')
                              ->where('nama_perawat','=',Auth::user()->nama)
                              ->whereDate('created_at','=', Carbon::today()->toDateString())
                              ->where('statusrm','=','selesai')
                              ->orwhere('statusrm','=','selesai dari radiologi')
                              ->get())}}                           
                    </h2>
                </div>  
              </div>
            </div>
          </div>


              @elseif($perawat->bidang == 'perawat radiologi')

        <div class="col-sm-4">

            <div class="card text-white bg-primary o-hidden mb-3">
            <div class="card-header">
                Pasien Belum di Periksa:
            </div>

            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa-fw fa fa-hourglass-start  "></i>
              </div>
           
              <div class="mr-5"> 
                  <h2 style="text-align: center;"> 
                           {{ count(DB::table('tb_daftars')
                              ->whereDate('created_at','=', Carbon::today()->toDateString())
                              ->where('statusdaftar','=','dirujuk ke radiologi')
                              ->orwhere('statusdaftar','=','sedang dalam radiologi')
                              ->get())}}                   
                  </h2>
              </div>  
            </div>
          </div>
        </div>
            @endif
            @endforeach
            @endif      
          </div>


  <div class="row">
   <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Pasien </div>
         
        <div class="card-body">
           <div class="table-responsive">
            <table class="table table-bordered" id="perawat" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tanggal Kedatangan</th>
                  <th>Nama </th>
                  <th>Nomor Rekam Medis</th>
                  <th>Poliklinik</th>
                  <th>Aksi</th>
                </tr>
              </thead>
             
              <tbody>
            @if(count($perawats)>0)
              @foreach($perawats as $perawat)
                @if($perawat->bidang == 'perawat penyakit dalam')

               @if(count($data)>0)
                 @foreach ($data as $dat)

                  @if($dat->statusdaftar == 'aktif')
              <tr>
                <td>{{$dat->created_at}}</td>
                <td>{{$dat->nama}}</td>
                <td>{{$dat->no_rm}}</td>
                <td>{{$dat->bidang}}</td>
                <td>
               
              <form method="POST" action="{{url('/tenkes/konfirmasi',array($dat->id))}}">
                                          @csrf     
                   <button type="submit" class="btn btn-sm btn-primary" title="konfirmasi" aria-label="konfirmasi">
                     <i class="fa fa-check" aria-hidden="true"></i>Konfirmasi

                                </button>
                 </form>   
                </td>
            </tr>

                @endif
               @endforeach
              @endif

            @elseif($perawat->bidang == 'perawat radiologi')
              @if(count($data)>0)
                 @foreach ($data as $dat)

                  @if($dat->statusdaftar == 'dirujuk ke radiologi')
              <tr>
                <td>{{$dat->created_at}}</td>
                <td>{{$dat->nama}}</td>
                <td>{{$dat->no_rm}}</td>
                <td>Radiologi</td>
                <td>
               
              <form method="POST" action="{{url('/tenkes/konfirmasi',array($dat->id))}}">
                                          @csrf     
                   <button type="submit" class="btn btn-sm btn-primary" title="konfirmasi" aria-label="konfirmasi">
                     <i class="fa fa-check" aria-hidden="true"></i>Konfirmasi

                                </button>
                 </form>   
                </td>
            </tr>

                @endif
               @endforeach
              @endif

            @endif
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

  
   
