@include('inc.headerauth')

 <title>{{ env('APP_NAME') }} - Dashboard</title> 
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
          Dashboard Dokter
        </li>
      </ol>
        @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif

     <div class="row">
     @if(count($dokter)>0)
              @foreach($dokter as $dok)  
                               @if($dok->bidang == 'Dokter Penyakit Dalam')    

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
                Pasien Belum di Periksa:
            </div>

            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa-fw fa fa-hourglass-start  "></i>
              </div>
              <div class="mr-5"> 
                 <h2 style="text-align: center;"> 
                     
                    {{count(DB::table('tb_daftars')
                                ->whereDate('created_at','=', Carbon::today()->toDateString())
                                ->where(function ($query) {
                                    $query->where('statusdaftar','=','aktif')
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
                          
                          {{count(DB::table('tb_hasils')
                              ->where('nama_dokter','=',Auth::user()->nama)
                              ->whereDate('created_at','=', Carbon::today()->toDateString())
                                ->where(function ($query) {
                                    $query->where('statusrm','=','selesai')
                                          ->orwhere('statusrm','=','dirujuk ke radiologi')
                                          ->orwhere('statusrm','=','sedang dalam radiologi');
                                         })
                                ->get())
                              }}              
                                         
                  </h2>
              </div>  
            </div>
          </div>
        </div>             
                        @elseif($dok->bidang == 'Dokter Radiologi')
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
                              ->orwhere('statusdaftar','=','sedang dalam radiologi')                              ->get())}}              
                     
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
                              ->where('nama_dokter','=',Auth::user()->nama)
                              ->whereDate('created_at','=', Carbon::today()->toDateString())
                              ->where('statusrm','=','selesai')
                              ->orwhere('statusrm','=','selesai dari radiologi')
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
          <i class="fa fa-table"></i> Daftar Pasien

           </div>                  
        <div class="card-body">
           <div class="table-responsive">
            <table id="perawat" class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tanggal Kedatangan</th>
                  <th>Nama </th>
                  <th>Nomor Rekam Medis</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
            @if(count($dokter)>0)
              @foreach($dokter as $dok)
              @if($dok->bidang == 'Dokter Penyakit Dalam')

               @if(count($datapenyakitdalam)>0)
                 @foreach ($datapenyakitdalam as $dat)

                            <tr>
                <td>{{$dat->created_at}}</td>
                <td>{{$dat->nama}}</td>
                <td>{{$dat->no_rm}}</td>
                <td>{{$dat->status}}</td>
                <td>
                 <a title="interview" class="btn btn-success btn-sm" href='{{url("dokter/interview/{$dat->user_id}")}}' aria-label="interview"> Interview
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a> 
                </td>
                </td>
            </tr>

               @endforeach
            @endif

             @if(count($datapostradio)>0)
                 @foreach($datapostradio as $datapost)
              <tr>
                <td>{{$datapost->created_at}}</td>
                <td>{{$datapost->nama}}</td>
                <td>{{$datapost->no_rm}}</td>
                <td>{{$datapost->status}}</td>
                <td>
                 <a title="interview" class="btn btn-success btn-sm" href='{{url("dokter/suntingrm/{$datapost->user_id}")}}' aria-label="interview"> Interview
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                </td>               
            </tr>
                  @endforeach
                @endif

          @endif

           @if($dok->bidang == 'Dokter Radiologi')
               @if(count($dataradiologi)>0)
                 @foreach ($dataradiologi as $dot)

              <tr>
                <td>{{$dot->created_at}}</td>
                <td>{{$dot->nama}}</td>
                <td>{{$dot->no_rm}}</td>
                <td>{{$dot->status}}</td>
                <td>
                  
                  <a title="interview" class="btn btn-success btn-sm" href='{{url("dokter/interview/{$dot->user_id}")}}' aria-label="interview"> Interview
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>

                </td>
            </tr>
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

  
   
