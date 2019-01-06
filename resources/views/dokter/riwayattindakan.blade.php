@include('inc.headerauth')
  <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
    @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
         <title>{{ env('APP_NAME') }} - Detail Tindakan Pasien</title> 
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('dokter.dashboard')}}">Dashboard</a>
          </li>
           <li class="breadcrumb-item active">Detail Tindakan Pasien</li>
              @endif

    @if(Auth::user()->level == 'resepsionis')
           <title>{{ env('APP_NAME') }} - Detail Kunjungan Pasien</title> 
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
               <a href="{{route('tenkes.dashboard')}}">Dashboard</a>
          </li>
             <li class="breadcrumb-item active">Detail Kunjungan Pasien</li>
                @endif
        </ol>
      <!-- Example DataTables Card-->
          <div class="card text-white bg-primary o-hidden mb-3">
            <div class="card-header">
                Profil Pasien
            </div>
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa-fw fa fa-hourglass-start "></i>
              </div>
            <div class="form-group">
              <div class="row">
                 @foreach ($profile as $dot)
                <div class="col-md-3">
                       <label for="nama_pasien">{{ __('Nama Lengkap ') }}</label>
                           <input id="nama_pasien" type="text" class="form-control{{ $errors->has('nama_pasien') ? ' is-invalid' : '' }}" name="nama_pasien" value="{{$dot->nama_pasien}}" readonly="readonly">  
                </div>
               
                 <div class="col-md-3">
                        <label for="tgl_lahir">{{__('Tanggal Lahir')}}</label>
                         <input id="tgl_lahir" type="text" class="form-control{{ $errors->has('tgl_lahir') ? ' is-invalid' : '' }}" name="tgl_lahir" value="{{Date::createFromFormat('Y-m-d',$dot->tgl_lahir)->format('d-F-Y')}}" readonly="readonly">
                          
                  </div>

                  <div class="col-md-3">
                        <label for="NIK">{{ __('Nomor Induk Kependudukan') }}</label>
                           <input id="NIK" type="text" class="form-control{{ $errors->has('NIK') ? ' is-invalid' : '' }}" name="NIK" value="{{$dot->NIK}}"  readonly="readonly">  
                             
                  </div>

                   <div class="col-md-3">
                        <label for="no_telp">{{__('Nomor Telepon')}}</label>
                         <input id="no_telp" type="text" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" name="no_telp" value="{{$dot->no_telp}}"  readonly="readonly">    
                    </div>

            </div>

            <div class="row">
               <div class="col-md-3">
                           <label for="no_rm">{{__('No Rekam Medis')}}</label>
                         <input id="no_rm" type="text" class="form-control{{ $errors->has('no_rm') ? ' is-invalid' : '' }}" name="no_rm" value="{{$dot->no_rm}}"  readonly="readonly">
                </div>

               <div class="col-md-3">
                        <label for="gol_darah">{{ __('Golongan Darah') }}</label>
                           <input id="gol_darah" type="text" class="form-control{{ $errors->has('gol_darah') ? ' is-invalid' : '' }}" name="gol_darah" value="{{$dot->gol_darah}}"  readonly="readonly">   
              </div>

               <div class="col-md-3">
                        <label for="jenis_kelamin">{{ __('Jenis Kelamin') }}</label>
                           <input id="jenis_kelamin" type="text" class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}" name="jenis_kelamin" value="{{$dot->jenis_kelamin}}"  readonly="readonly">   
              </div>
               @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
                <div class="col-md-3">
                       <label for="exportpdf">{{ __(' Ekspor PDF') }}</label>
                         <br>
                   <a title="exportpdf" class="btn btn-success btn-xl" href='{{url("/dokter/riwayattindakan/PDF/{$dot->user_id}")}}' aria-label="exportpdf"> Ekspor PDF
                  </a>
              </div>            
              @elseif(Auth::user()->level == 'resepsionis') 

            @endif
                 
                               @endforeach

            </div>
          </div>
        </div>  
      </div>



       
                <div class="card mb-3">
                   <div class="card-header">
                          <div class="form-group row mb-0">
                            <div class="col-md-8">
                        @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
                              <i class="fa fa-table"></i> Detail Tindakan Pasien
                      @elseif(Auth::user()->level == 'resepsionis')
                              <i class="fa fa-table"></i> Detail Kunjungan Pasien
                      @endif
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
        @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
            <table class="table table-bordered " id="riwayattindakan" width="100%" cellspacing="0">
        @elseif(Auth::user()->level == 'resepsionis')
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
        @endif
              <thead>
                <tr>
                  <th>Tanggal Kedatangan</th>
          @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
                  <th>Dokter </th>
                  <th>Perawat</th>
                  <th>Keluhan</th>
                   <th>Penyakit</th>
                  <th>Obat</th>
                  <th>Catatan Dokter</th>
          @elseif(Auth::user()->level == 'resepsionis')
                  <th>Poliklinik</th>
          @endif
                 
                </tr>
              </thead>
             
              <tbody>

               @if(count($data)>0)
                 @foreach ($data as $dat)

              <tr>
        @if(Auth::user()->level == 'dokter' || Auth::user()->level == 'perawat')
                <td>{{$dat->updated_at}}</td>
                <td>{{$dat->nama_dokter}}</td>
                <td>{{$dat->nama_perawat}}</td>
                <td>{{$dat->keluhan}}</td>
                <td>{{$dat->nama_penyakit}}</td>
                <td>{{$dat->nama_obat}}</td>
                <td>{{$dat->catatan_dokter}}</td>
        @elseif(Auth::user()->level == 'resepsionis')
                <td>{{$dat->created_at}}</td>
                <td>{{$dat->bidang}}</td>
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
  </div>
    
 @include('inc.footerauth')