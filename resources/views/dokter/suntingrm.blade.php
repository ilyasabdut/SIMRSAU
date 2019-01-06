@include('inc.headerauth')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('dokter.dashboard')}}">Pasien</a>
        </li>
        <li class="breadcrumb-item active">Sunting Rekam Medis</li>
      </ol>
     <title>{{ env('APP_NAME') }} - Sunting Rekam Medis</title> 
<body>
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Sunting Rekam Medis</div>
      <div class="card-body">
          @if(count($data)>0)
            @foreach($data as $dat)
   <form method="POST" action="{{url('/dokter/suntingrms',array($dat->user_id))}}">
                        @csrf     
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
          
                        <label for="nama_pasien">{{ __('Nama Lengkap Pasien') }}</label>
                           <input id="nama_pasien" type="text" class="form-control{{ $errors->has('nama_pasien') ? ' is-invalid' : '' }}" name="nama_pasien" value="{{$dat->nama_pasien}}" readonly="readonly">  
                             
                              </div>

            <div class="col-md-6">
                        <label for="no_rm">{{__('No Rekam Medis')}}</label>
                         <input id="no_rm" type="text" class="form-control{{ $errors->has('no_rm') ? ' is-invalid' : '' }}" name="no_rm" value="{{$dat->no_rm}}" readonly="readonly">
                          
                                      </div>
                                </div>
                              </div>

           <div class="form-group">
                        <label for="keluhan">{{ __('Keluhan') }}</label>
                           <textarea id="keluhan" type="text" class="form-control{{ $errors->has('keluhan') ? ' is-invalid' : '' }}" name="keluhan" cols="40" rows="3" readonly="readonly">{{$dat->keluhan}}</textarea>     
                        </div>
            


          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                            <label for="nama_dokter">{{__('Nama Dokter ')}}</label>
                              <input id="nama_dokter" type="text" class="form-control{{ $errors->has('nama_dokter') ? ' is-invalid' : '' }}"  name="nama_dokter" value="{{$dat->nama_dokter}}" readonly="readonly">
                                            
                                </div>
          


                <div class="col-md-6">
                            <label for="nama_perawat">{{__('Nama Perawat ')}}</label>
                              <input id="nama_perawat" type="text" class="form-control{{ $errors->has('nama_perawat') ? ' is-invalid' : '' }}" name="nama_perawat"  value="{{$dat->nama_perawat}}" readonly="readonly">

                                          
                                </div>
                          </div>
                        </div>
          

    <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                            <label for="nama_penyakit">{{__('Nama Penyakit ')}}</label>
                              <input id="nama_penyakit" type="text" class="form-control{{ $errors->has('nama_penyakit') ? ' is-invalid' : '' }}"  name="nama_penyakit"  value="{{$dat->nama_penyakit}}">

                                 <script type="text/javascript">

                                    $("#nama_penyakit").select2({
                                          placeholder: "Ketik Nama Penyakit",
                                          allowClear: true
                                      });
                              </script>

                                </div>
                              </div>
                            </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-6">
                <label for="obat">{{__('Apakah Butuh Obat? ')}}</label> <br>
              </div>
               <div class="col-md-6 offset-md-4">
                <input id="obat" type="radio" name="obat" input onclick="document.getElementById('nama_obat').disabled = false;" checked="checked"> Ya
                <input id="obat" type="radio" name="obat" input onclick="document.getElementById('nama_obat').disabled = true;"> Tidak
              </div>
            </div>
        </div>

      <div class="form-group">
          <div class="form-row">
                <div class="col-md-12">
                            <label for="nama_obat">{{__('Nama Obat ')}}</label>

                              <input id="nama_obat" type="text" class="form-control{{ $errors->has('nama_obat') ? ' is-invalid' : '' }}"  name="nama_obat" value="{{$dat->nama_obat}}" >
                                                                       
                                </div>
                          </div>
                        </div>

                <div class="form-group">
                        <label for="catatan_dokter">{{ __('Catatan Dokter') }}</label>
                           <textarea id="catatan_dokter" type="text" class="form-control{{ $errors->has('catatan_dokter') ? ' is-invalid' : '' }}" name="catatan_dokter" cols="40" rows="3" >{{$dat->catatan_dokter}}</textarea>     
                        </div>

           <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                            <label for="status">{{__('Status Pasien ')}}</label>
                              <select id="status" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"  name="status"  >
                               <option disabled selected value> -- select an option -- </option>
                               <option value="selesai">Selesai</option>
                              </select>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                </div>
                          </div>
                        </div>
        
              @endforeach
          @endif
           
          <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                                <a  class="btn btn-secondary" href="javascript:history.back()">
                                    {{ __('Back') }}
                                </a>
                            </div>
                      </div>
            </div>
          </div>
        </div>
  
</body>
</div>
</div>
   @include('inc.footerauth')
