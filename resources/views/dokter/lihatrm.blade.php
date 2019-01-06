@include('inc.headerauth')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('pasien.dashboard')}}">Pasien</a>
        </li>
        <li class="breadcrumb-item active">Rekam Medis</li>
      </ol>
     <title>{{ env('APP_NAME') }} - Rekam Medis</title> 

<body>
  <div class="container">
     @if(count($rm)>0)
            @foreach($rm as $dat)

 <div class="card card-register text-white mx-auto bg-primary o-hidden mb-3">
     <div class="card-header"> Profil Pasien  </div>
            <div class="card-body">
              <form>

            <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
           
                        <label for="nama_pasien">{{ __('Nama Lengkap Pasien') }}</label>
                           <input id="nama_pasien" type="text" class="form-control{{ $errors->has('nama_pasien') ? ' is-invalid' : '' }}" name="nama_pasien" maxlength="25" value="{{$dat->nama_pasien}}" readonly="readonly">  
                             
                              </div>

            <div class="col-md-6">
                        <label for="no_rm">{{__('No Rekam Medis')}}</label>
                         <input id="no_rm" type="text" class="form-control{{ $errors->has('no_rm') ? ' is-invalid' : '' }}" name="no_rm" maxlength="5"  value="{{$dat->no_rm}}" readonly="readonly">
                          
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
            </div>
          </div>
        </div>
      </div>


    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Rekam Medis Pasien  
                      <span style="float: right;">    Tanggal Kunjungan: {{Date::createFromFormat('Y-m-d H:i:s',$dat->tgldtg)->format('l, d-F-Y')}}</span>

      </div>
        

        <div class="card-body">
   <form>
          
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                            <label for="nama_dokter">{{__('Nama Dokter ')}}</label>
                              <input id="nama_dokter" type="text" class="form-control{{ $errors->has('nama_dokter') ? ' is-invalid' : '' }}"  name="nama_dokter" value="{{$dat->nama_dokter}}" readonly="readonly">
                                            
                                </div>
        


                <div class="col-md-6">
                            <label for="nama_perawat">{{__('Nama Perawat ')}}</label>
                              <input id="nama_perawat" type="text" class="form-control{{ $errors->has('nama_perawat') ? ' is-invalid' : '' }}"  name="nama_perawat" value="{{$dat->nama_perawat}}" readonly="readonly">
                                </div>
                          </div>
                        </div>
              <div class="form-group">
                        <label for="keluhan">{{ __('Keluhan') }}</label>
                           <textarea id="keluhan" type="text" class="form-control{{ $errors->has('keluhan') ? ' is-invalid' : '' }}" name="keluhan" cols="40" rows="3" readonly="readonly">{{$dat->keluhan}}</textarea>   
                  </div>
          
    <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                            <label for="nama_penyakit">{{__('Nama Penyakit ')}}</label>
                              <input id="nama_penyakit" type="text" class="form-control{{ $errors->has('nama_penyakit') ? ' is-invalid' : '' }}"  name="nama_penyakit" value="{{$dat->nama_penyakit}}" readonly="readonly">
                                </div>
                              </div>
                            </div>
    

      <div class="form-group">
          <div class="form-row">
                <div class="col-md-12">
                            <label for="nama_obat">{{__('Nama Obat ')}}</label>
                              <input id="nama_obat" type="text" class="form-control{{ $errors->has('nama_obat') ? ' is-invalid' : '' }}"  name="nama_obat" value="{{$dat->nama_obat}}" readonly="readonly">
                              
                                </div>
                          </div>
                        </div>

        <div class="form-group">
                        <label for="catatan_dokter">{{ __('Catatan Dokter') }}</label>
                           <textarea id="catatan_dokter" type="text" class="form-control{{ $errors->has('catatan_dokter') ? ' is-invalid' : '' }}" name="catatan_dokter" cols="40" rows="3" readonly="readonly">{{$dat->catatan_dokter}}</textarea>     
                  </div>
           
          <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                             
                                <a  class="btn btn-secondary" href="javascript:history.back()">
                                    {{ __('Kembali') }}
                                </a>

                            </div>
                      </div>
                    </form>
                      @endforeach
          @endif
            </div>
          </div>
        </div>
</body>
</div>
</div>
   @include('inc.footerauth')
