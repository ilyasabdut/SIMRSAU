@include('inc.headerauth')
  <meta http-equiv="refresh" content="60" />
     <title>{{ config('app.name') }} - Dashboard</title> 
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('pasien.dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">{{ Auth::user()->level }}</li>
      </ol>
      @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif

      <div class="row">
        <div class="col-lg-6">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> Pendaftaran Aktif
                           @foreach ($pasiens as $dat)
                           @if($loop->first)
                      <span style="float: right;">    Nomor Rekam Medis: {{$dat->no_rm}}</span>
                            @endif
                      @endforeach
            </div> 
            <div class="card-body">
              <div class="row">
                 <div class="table-responsive">
            <table class="table table-bordered" id="pasien" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tanggal Kedatangan</th>
                  <th>Bidang</th>
                </tr>
              </thead>


              <tbody>
             @foreach ($pasiens as $dat)
                 @if($dat->statusdaftar == 'non-aktif' ||
                    $dat->statusdaftar == 'aktif')
              <tr>
                <td>{{Date::createFromFormat('Y-m-d',$dat->tgl_kedatangan)->format('l, d F Y')}}</td>
                <td>{{$dat->bidang}}</td>
            </tr>
                @elseif($dat->statusdaftar == 'dirujuk ke radiologi' || 
                    $dat->statusdaftar == 'sedang dalam radiologi' ||
                    $dat->statusdaftar == 'selesai dari radiologi')
            <tr>
                <td>{{Date::createFromFormat('Y-m-d',$dat->tgl_kedatangan)->format('l, d F Y')}}</td>
                <td>Radiologi</td>
            </tr>

            @elseif($dat->statusdaftar == 'selesai' || $dat->statusdaftar == null)

              @endif
               @endforeach
              </tbody>
            </table>
          </div>
              </div>
            </div>
          </div>           
        </div>

 
        <div class="col-sm-6">
          <div class="row">
                  <div class="col-sm-6">
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

          <div class="col-sm-6">
            <div class="card text-white bg-primary o-hidden mb-3">
            <div class="card-header">
                Nomor Antrian:
            </div>
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa-fw fa fa-hourglass-start  "></i>
              </div>
              <div class="mr-5"> 

                @if($dat->status == "aktif" || $dat->status == "selesai" ||$dat->status == "non-aktif")
                  Anda belum mendaftar kunjungan <br>
                  
                @elseif($dat->status == "Terkonfirmasi. Silahkan tunggu antrian")
                    <h2 style="text-align: center;"> 
                    {{$dat->antrian}}
                    </h2>

                @elseif(
                        $dat->status == "menunggu" ||
                        $dat->status == "sedang dalam ruangan" ||
                        $dat->status == "sedang dalam radiologi" ||  
                        $dat->status == "dirujuk ke radiologi" ||
                        $dat->status == "selesai dari radiologi" || 
                        $dat->status == "Ditolak. Silahkan ulangi pendaftaran")
                     <h2 style="text-align: center;"> 
                        -
                      </h2>
                

                @endif

              </div>  
            </div>
          </div>
        </div>
      </div>


        <div class="card text-white bg-primary o-hidden mb-3">
            <div class="card-header">
              Status Pasien
            </div>
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-info"></i>
              </div>

              <div class="mr-5"> 
                @if($dat->status == "aktif" ||   $dat->status == "selesai" ||$dat->status == "non-aktif")

                                  Anda belum mendaftar kunjungan

                @elseif(  $dat->status == "menunggu" )

                Silahkan verifikasi ke resepsionis

                @elseif(
                    $dat->status == "Terkonfirmasi. Silahkan tunggu antrian" ||
                    $dat->status == "sedang dalam ruangan" ||
                    $dat->status == "dirujuk ke radiologi" || 
                    $dat->status == "sedang dalam radiologi" || 
                    $dat->status == "selesai dari radiologi" || 
                    $dat->status == "Ditolak. Silahkan ulangi pendaftaran")

                 {{$dat->status}}
                  

                @endif

              </div>  
            </div>
          </div>
      </div>          
      </div>
     
     <div class="row">
   <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Riwayat Rekam Medis
          @if(count($riwayat) == 0)

          @else
               <span style="float: right;"> 
                   <a title="exportpdf" class="btn btn-success btn-sm" href='{{url("/dokter/riwayattindakan/PDF/{$dat->user_id}")}}' aria-label="exportpdf"> Ekspor PDF
                  </a>
          @endif
        </div>
        <div class="card-body">
           <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tanggal Kedatangan</th>
                  <th>Nama Dokter</th>
                  <th>Nama Penyakit</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                @if(count($riwayat)>0)
                 @foreach ($riwayat as $dat)  
              <tr>
                <td>{{$dat->created_at}} </td>
                <td>{{$dat->nama_dokter}}</td>
                <td>{{$dat->nama_penyakit}}</td>
                <td>
                  
                  <a title="read" class="btn btn-primary btn-sm" href='{{url("/pasien/lihatrm/{$dat->id}")}}' aria-label="read"> Detail
                    <i class="fa fa-book" aria-hidden="true"></i>
                  </a>
                   <a title="exportpdf" class="btn btn-success btn-sm" href='{{url("/pasien/lihatrm/PDF/{$dat->id}")}}' aria-label="exportpdf"> PDF
                                </a>

                </td>
            </tr>
               @endforeach
            @endif     
              </tbody>
            </table>
          </div>
          </div>
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

  
   
