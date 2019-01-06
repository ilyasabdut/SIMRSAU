@include('inc.headerauth')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="\pasien">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Registrasi</li>
      </ol>
     <title>{{ env('APP_NAME') }} - Registrasi</title> 
     
<body>  
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrasi Kunjungan</div>

       @if(count($data)>0)
                 @foreach ($data as $dat)
      <div class="card-body">
   <form method="POST" action="{{route('pasien.daftars')}}">
                        @csrf     
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                        <label for="nama_pasien">{{ __('Nama Lengkap') }}</label>
                           <input id="nama_pasien" type="text" class="form-control{{ $errors->has('nama_pasien') ? ' is-invalid' : '' }}" name="nama_pasien" maxlength="25" readonly="readonly" value="{{$dat->nama}}"> 

                              </div>
            <input id="user_id" type="text" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" maxlength="25" value="{{$dat->id}}" hidden="hidden"> 


            <div class="col-md-6">
                        <label for="no_rm">{{__('No Rekam Medis')}}</label>
                         <input id="no_rm" type="no_rm" class="form-control{{ $errors->has('no_rm') ? ' is-invalid' : '' }}" name="no_rm" maxlength="5"  value="{{$dat->no_rm}}" readonly="readonly">
                         
                                      </div>
                                </div>
                              </div>
     <div class="form-group">
      <div class="form-row">
           <div class="col-md-6">
           
                        <label for="gol_darah">{{ __('Golongan Darah') }}</label>
                           <input id="gol_darah" type="text" class="form-control{{ $errors->has('gol_darah') ? ' is-invalid' : '' }}" name="gol_darah" maxlength="25" value="{{$dat->gol_darah}}" readonly="readonly">  
                             
                              </div>

            <div class="col-md-6">
                        <label for="tgl_lahir">{{__('Tanggal Lahir')}}</label>
                         <input id="tgl_lahir" type="text" class="form-control{{ $errors->has('tgl_lahir') ? ' is-invalid' : '' }}" name="tgl_lahir" maxlength="5"  value="{{Date::createFromFormat('Y-m-d',$dat->tgl_lahir)->format('d-F-Y')}}" readonly="readonly">
                          
                                      </div>
                                </div>
                              </div>
    
    <div class="form-group">
      <div class="form-row">
           <div class="col-md-6">
           
                        <label for="NIK">{{ __('Nomor Induk Kependudukan') }}</label>
                           <input id="NIK" type="text" class="form-control{{ $errors->has('NIK') ? ' is-invalid' : '' }}" name="NIK" maxlength="25" value="{{$dat->NIK}}" readonly="readonly">  
                             
                              </div>

            <div class="col-md-6">
                        <label for="no_telp">{{__('Nomor Telepon')}}</label>
                         <input id="no_telp" type="text" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" name="no_telp" maxlength="5"  value="{{$dat->no_telp}}" readonly="readonly">
                          
                                      </div>
                                </div>
                              </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                            <label for="tgl_kedatangan">{{__('Tanggal Kedatangan')}}</label>
                            <input id="tgl_kedatangan" type="date" class="form-control{{ $errors->has('tgl_kedatangan') ? ' is-invalid' : '' }}" name="tgl_kedatangan" required min={{Carbon\Carbon::now()}} >
                               @if ($errors->has('tgl_kedatangan'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('tgl_kedatangan') }}</strong>
                                                </span>
                                            @endif
                          </div>
                    </div>
                  </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                            <label for="bidang">{{__('Poliklinik')}}</label>
                              <select id="bidang" type="text" class="form-control{{ $errors->has('bidang') ? ' is-invalid' : '' }}"  name="bidang"  required>
                               <option disabled selected value> -- select an option -- </option>
                              <option> Penyakit Dalam

                              </option>

                              </select>
                                            @if ($errors->has('nama_dokter'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_dokter') }}</strong>
                                                </span>
                                            @endif
                                </div>
                          </div>
                        </div>

          
           
  
          <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Daftar') }}
                                </button>
                                <a  class="btn btn-secondary" href="javascript:history.back()">
                                    {{ __('Kembali') }}
                                </a>
                            </div>
                      </div>
                    </form>
      </div>
      @endforeach
      @endif
    </div>
  </div>
</body>
</div>
</div>
   @include('inc.footerauth')
