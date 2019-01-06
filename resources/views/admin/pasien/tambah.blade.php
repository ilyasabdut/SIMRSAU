@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} -  Tambah</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Tambah </a>
        </li>
       
      </ol>
      <!-- Example DataTables Card-->
    <div class="card card-register mx-auto mt-5">

		        <div class="card-header">

		           <div class="row">
		              <div class="col-sm-9">
		                <i class="fa fa-table"></i> Tambah Pasien
		              </div>    
  		      	</div>
  		      </div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.pasien.insert')}}">
                        @csrf
                   <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama">{{ __('Nama Lengkap') }}</label>
                           <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" maxlength="25" required>  
                             @if ($errors->has('nama'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama') }}</strong>
                                                </span>
                                            @endif       
                              </div>
                              
                         <div class="col-md-6">
                        <label for="no_rm">{{__('No Rekam Medis')}}</label>
                         <input id="no_rm" type="no_rm" class="form-control{{ $errors->has('no_rm') ? ' is-invalid' : '' }}" name="no_rm" maxlength="5"  required>
                          @if ($errors->has('no_rm'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_rm') }}</strong>
                                                </span>
                                            @endif
                        </div>
                      </div>
                    </div>
                  
                <div class="form-group">
                  <div class="form-row">
                      <div class="col-md-6">
                        <label for="email">{{__('E-Mail')}}</label>
                         <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" maxlength="25" required>
                               @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                               </div>
                              
                         <div class="col-md-6">
                 <label for="NIK">{{ __('NIK') }}</label>
                           <input id="NIK" type="text" class="form-control{{ $errors->has('NIK') ? ' is-invalid' : '' }}" name="NIK" maxlength="16" required> 
                     @if ($errors->has('NIK'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('NIK') }}</strong>
                                                </span>
                                            @endif
                                 </div>
                              </div>
                          </div>

               <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="jenis_kelamin">{{__('Jenis Kelamin')}}</label>
                              <select id="jenis_kelamin" type="text" class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}"  name="jenis_kelamin"  required>
                                <option disabled selected value> -- select an option -- </option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>

                              </select>
                                            @if ($errors->has('jenis_kelamin'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                                </span>
                                            @endif
                                </div>

                          <div class="col-md-6">
                            <label for="tgl_lahir">{{__('Tanggal Lahir')}}</label>
                            <input id="tgl_lahir" type="date" class="form-control{{ $errors->has('tgl_lahir') ? ' is-invalid' : '' }}" name="tgl_lahir" maxlength="20" required>
                               @if ($errors->has('tgl_lahir'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('tgl_lahir') }}</strong>
                                                </span>
                                            @endif
                          </div>
                      </div>
                    </div>

                     <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="gol_darah">{{__('Golongan Darah')}}</label>
                              <select id="gol_darah" type="text" class="form-control{{ $errors->has('gol_darah') ? ' is-invalid' : '' }}"  name="gol_darah"  required>
                                <option disabled selected value> -- select an option -- </option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>

                              </select>
                                            @if ($errors->has('gol_darah'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('gol_darah') }}</strong>
                                                </span>
                                            @endif
                                </div>

                          <div class="col-md-6">
                            <label for="no_telp">{{__('Nomor Telepon')}}</label>
                            <input id="no_telp" type="phone" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" name="no_telp" maxlength="15" required>
                               @if ($errors->has('no_telp'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('no_telp') }}</strong>
                                                </span>
                                            @endif
                          </div>
                      </div>
                    </div>
                <div class="form-group">
                   <div class="form-row">
                  <div class="col-md-12">
                    <label for="alamat">{{__('Alamat')}}</label>
                    <input id="alamat" type="alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" maxlength="50" required>
                                      @if ($errors->has('alamat'))
                                          <span class="invalid-feedback">
                                              <strong>{{ $errors->first('alamat') }}</strong>
                                          </span>
                                      @endif
                   </div>
               </div>
              </div>

                <div class="form-group">
                   <div class="form-row">
                  <div class="col-md-6">
                    <label for="password">{{__('Kata Sandi')}}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" maxlength="25" required>
                                      @if ($errors->has('password'))
                                          <span class="invalid-feedback">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                </div>
                      <div class="col-md-6">
        		            <label for="password-confirm">{{__('Konfirmasi Kata Sandi')}}</label>
        		            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" maxlength="25" required>
                      </div>
                  </div>
                </div>
        
        	 			<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah') }}
                                </button>
                                <a  class="btn btn-secondary" href="javascript:history.back()">
                                    {{ __('Kembali') }}
                                </a>
                            </div>
                   		</div>
        		</form>
     		 </div>
         </div>
    </div>
</div>
    
 @include('inc.footerauth')

