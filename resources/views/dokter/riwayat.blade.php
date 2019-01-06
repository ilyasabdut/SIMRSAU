@include('inc.headerauth')

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
  @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
       <title>{{ env('APP_NAME') }} - Riwayat Kunjungan Pasien</title> 
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('dokter.dashboard')}}">Dashboard</a>
        </li>
         <li class="breadcrumb-item active">Riwayat Kunjungan Pasien</li>
            @endif

  @if(Auth::user()->level == 'resepsionis')
         <title>{{ env('APP_NAME') }} - Riwayat Kunjungan Pasien</title> 
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
             <a href="{{route('tenkes.dashboard')}}">Dashboard</a>
        </li>
           <li class="breadcrumb-item active">Riwayat Kunjungan Pasien</li>
              @endif
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
         <div class="card-header">
                <div class="form-group row mb-0">
                  <div class="col-md-8">
                <i class="fa fa-table"></i> Riwayat Kunjungan Pasien                                                
                  </div>    
               </div>

                @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif
            </div>

        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tanggal Kedatangan</th>
                  <th>Nama </th>
                  <th>Nomor Rekam Medis</th>
            @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
                  <th>Nama Dokter</th>
            @elseif(Auth::user()->level == 'resepsionis') 

            @endif
                  <th>Aksi</th>
                </tr>
              </thead>
             
              <tbody>

               @if(count($data)>0)
                 @foreach ($data as $dat)

              <tr>
                <td>{{$dat->updated_at}}</td>
                <td>{{$dat->nama_pasien}}</td>
                <td>{{$dat->no_rm}}</td>

                  @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
                <td>{{$dat->nama_dokter}}</td>

                <td>

                  <a title="read" class="btn btn-primary btn-sm" href='{{url("/dokter/riwayattindakan/{$dat->user_id}")}}' aria-label="read"> Detail
                    <i class="fa fa-book" aria-hidden="true"></i>
                  </a>
              
                @elseif(Auth::user()->level == 'resepsionis') 
   
                <td>
                  <a title="read" class="btn btn-primary btn-sm" href='{{url("/dokter/riwayattindakan/{$dat->user_id}")}}' aria-label="read"> Detail
                    <i class="fa fa-book" aria-hidden="true"></i>
                  </a>
                @endif
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
    
 @include('inc.footerauth')

