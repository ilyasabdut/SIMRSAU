@include('inc.headerauth')
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('dokter.dashboard')}}">Pasien</a>
        </li>
        <li class="breadcrumb-item active">Interview</li>
      </ol>
     <title>{{ env('APP_NAME') }} - Interview</title> 
<body>
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Interview Pasien</div>
      <div class="card-body">
         @if(count($data)>0)
            @foreach($data as $dat)

        
   <form method="POST" action="{{url('/dokter/interviews',array($dat->user_id))}}">
                        @csrf     
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">


                        <label for="nama_pasien">{{ __('Nama Lengkap Pasien') }}</label>
                           <input id="nama_pasien" type="text" class="form-control{{ $errors->has('nama_pasien') ? ' is-invalid' : '' }}" name="nama_pasien" maxlength="25" value="{{$dat->nama_pasien}}" readonly="readonly">  
                             
                              </div>

            <div class="col-md-6">
                        <label for="no_rm">{{__('No Rekam Medis')}}</label>
                         <input id="no_rm" type="text" class="form-control{{ $errors->has('no_rm') ? ' is-invalid' : '' }}" name="no_rm" maxlength="5"  value="{{$dat->no_rm}}" readonly="readonly">

                         <input id="user_id" type="text" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" maxlength="5"  value="{{$dat->user_id}}" hidden="hidden">


                                      </div>
                                </div>
                              </div>

         <div class="form-group">
                          @if($dat->statusdaftar == 'aktif')

                        <label for="keluhan">{{ __('Keluhan') }}</label>
                          <input disabled  maxlength="3" size="3" value="300" id="counter">
                           <textarea id="keluhan" onkeyup="textCounter(this,'counter',300);" class="form-control" name="keluhan" maxlength="300" rows="3"  required autofocus="autofocus"></textarea>  
                            
                                            <div class="form-group">
 
                                                  <script>
                                                  function textCounter(field,field2,maxlimit)
                                                  {
                                                   var countfield = document.getElementById(field2);
                                                   if ( field.value.length > maxlimit ) {
                                                    field.value = field.value.substring( 0, maxlimit );
                                                    return false;
                                                   } else {
                                                    countfield.value = maxlimit - field.value.length;
                                                   }
                                                  }
                                                  </script>
                      @elseif($dat->statusdaftar == 'sedang dalam radiologi')

                      @endif

                              </div>


      
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                @if($dat->statusdaftar == 'aktif')
                            <label for="nama_dokter">{{__('Nama Dokter ')}}</label>
                              <input id="nama_dokter" type="text" class="form-control{{ $errors->has('nama_dokter') ? ' is-invalid' : '' }}"  name="nama_dokter" value="{{Auth::user()->nama}}" readonly="readonly">
                                            @if ($errors->has('nama_dokter'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_dokter') }}</strong>
                                                </span>
                                            @endif
                                </div>
                @elseif($dat->statusdaftar == 'sedang dalam radiologi')
                         <label for="tgl_kedatangan">{{__('Tanggal Kedatangan')}}</label>
                              <input id="tgl_kedatangan" type="text" class="form-control{{ $errors->has('tgl_kedatangan') ? ' is-invalid' : '' }}"  name="tgl_kedatangan" value="{{Date::createFromFormat('Y-m-d H:i:s',$dat->updated_at)->format('l, d F Y H:i')}}" readonly="readonly">
                                          
                                </div>
                @endif
        


                <div class="col-md-6">
              @if($dat->statusdaftar == 'aktif')
                            <label for="nama_perawat">{{__('Nama Perawat ')}}</label>
                              <select id="nama_perawat" type="text" class="form-control{{ $errors->has('nama_perawat') ? ' is-invalid' : '' }}" name="nama_perawat"  required>
                               <option></option>
                                @foreach($namaperawats as $namaperawat)
                             <option value="{{$namaperawat->nama}}">{{$namaperawat->nama}}</option>
                              @endforeach
                              </select>
                              <script type="text/javascript">
                                    $("#nama_perawat").select2({
                                          placeholder: "Ketik Nama Perawat",
                                          allowClear: true
                                      });
                              </script>
                                            @if ($errors->has('nama_perawat'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_perawat') }}</strong>
                                                </span>
                                            @endif


                      @elseif($dat->statusdaftar == 'sedang dalam radiologi')
                        <label for="nama_radiologi">{{__('Nama Dokter Radiologi ')}}</label>
                              <input id="nama_radiologi" type="text" class="form-control{{ $errors->has('nama_radiologi') ? ' is-invalid' : '' }}" name="nama_radiologi"  readonly="readonly" value="{{Auth::user()->nama}}"> 
                    @endif
   
                                </div>
                          </div>
                        </div>
          
          @if($dat->statusdaftar == 'aktif')
    <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                            <label for="nama_penyakit">{{__('Nama Penyakit ')}}</label>
                              <select id="nama_penyakit" type="text" class="form-control"  name="nama_penyakit"  required>
                             <option></option>
                              @foreach($namapenyakits as $namapenyakit)
                             <option value="{{$namapenyakit->nama_penyakit}}">
                              {{$namapenyakit->nama_penyakit}}
                            </option>
                              @endforeach

                              </select>


                              <script type="text/javascript">

                                    $("#nama_penyakit").select2({
                                          placeholder: "Ketik Nama Penyakit",
                                          allowClear: true
                                      });
                              </script>
                                            @if ($errors->has('nama_penyakit'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_penyakit') }}</strong>
                                                </span>
                                            @endif
                                </div>
                              </div>
                            </div>

    <div class="form-group">
        <div class="form-row">
            <div class="col-md-6">
                <label for="obat">{{__('Apakah Butuh Obat? ')}}</label> <br>
              </div>
               <div class="col-md-6 offset-md-4">
                <input id="obat" type="radio" name="obat" input onclick="document.getElementById('nama_obat').disabled = false;" checked="true"> Ya
                <input id="obat" type="radio" name="obat" input onclick="document.getElementById('nama_obat').disabled = true;" > Tidak
              </div>
            </div>
        </div>



      <div class="form-group">
          <div class="form-row">
                <div class="col-md-12">
                            <label for="nama_obat">{{__('Nama Obat ')}}</label>
                              <select id="nama_obat" type="text" class="form-control{{ $errors->has('nama_obat') ? ' is-invalid' : '' }}"  name="nama_obat[]"  multiple="multiple">
                             @foreach($namaobats as $namaobat)
                             <option value="{{$namaobat->nama_obat}}">{{$namaobat->nama_obat}}</option>
                              @endforeach
                              </select>

                               <script type="text/javascript">
                                    $("#nama_obat").select2({
                                          placeholder: "Ketik Nama Obat",
                                          allowClear: true
                                      });
                              </script>
                          
                                                                  @if ($errors->has('nama_obat'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_obat') }}</strong>
                                                </span>
                                            @endif
                                </div>
                          </div>
                        </div>

                <div class="form-group">
                       <label for="catatan_dokter">{{ __('Catatan Dokter') }}</label>
                          <input disabled  maxlength="3" size="3" value="300" id="counters">
                          <textarea  class="form-control" name="catatan_dokter" rows="3" maxlength="300" id="catatan_dokter" onkeyup="textCounter(this,'counters',300);" required></textarea>    

                    </div>
                                      


            <div class="form-group">
          <div class="form-row">
                <div class="col-md-12">
                            <label for="status">{{__('Status Pasien ')}}</label>
                              <select id="status" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"  name="status">

                               <option disabled selected value> -- select an option -- </option>
                               <option value="dirujuk ke radiologi">Rujukan ke Radiologi</option>
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
  @elseif($dat->statusdaftar = 'sedang dalam radiologi')

  <div class="form-group">
          <div class="form-row">
                <div class="col-md-12">
                            <label for="status">{{__('Status Pasien ')}}</label>
                              <select id="status" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"  name="status"  >
                               <option disabled selected value> -- select an option -- </option>
                               <option value="selesai dari radiologi">Selesai dan kembali ke Dokter Penyakit Dalam</option>
                              </select>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                </div>
                          </div>
                        </div>

@endif
          <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Selesai') }}
                                </button>
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
