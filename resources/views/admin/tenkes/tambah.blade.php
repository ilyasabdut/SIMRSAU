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
		                <i class="fa fa-table"></i> Tambah Tenaga Kesehatan
		              </div>    
  		      	</div>
  		      </div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.tenkes.insert')}}">
                        @csrf
					           <div class="form-group">
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
                        <label for="kd_dokter">{{__('Kode Dokter')}}</label>
                         <input id="kd_dokter" type="kd_dokter" class="form-control{{ $errors->has('kd_dokter') ? ' is-invalid' : '' }}" name="kd_dokter" maxlength="5"  required>
                          @if ($errors->has('kd_dokter'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('kd_dokter') }}</strong>
                                                </span>
                                            @endif
                        </div>
                      </div>
                    </div>
                 

                <div class="form-group">
                  <div class="form-row">
                     <div class="col-md-6">
                        <label for="NIK">{{__('NIK')}}</label>
                         <input id="NIK" type="NIK" class="form-control{{ $errors->has('NIK') ? ' is-invalid' : '' }}" name="NIK" maxlength="16" required>
                               @if ($errors->has('NIK'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('NIK') }}</strong>
                                                </span>
                                            @endif
                               </div>
                      <div class="col-md-6">
                        <label for="email">{{__('E-Mail')}}</label>
                         <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" maxlength="25" required>
                               @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                               </div>
                              
  
                              </div>
                          </div>

               <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="bidang">{{__('Bidang Profesi')}}</label>
                               <select id="bidang" type="text" class="form-control" name="bidang"  required>
                                <option disabled selected value> -- select an option -- </option>
                                <option value="Dokter Penyakit Dalam">Dokter Penyakit Dalam</option>
                                <option value="Dokter Radiologi">Dokter Radiologi</option>
                                <option value="perawat">Perawat</option>
                                <option value="resepsionis">Resepsionis</option>

                              </select>
                                           
                                </div>

                          <div class="col-md-6">
                            <label for="pangkat">{{__('Pangkat')}}</label>
                           <select id="pangkat" type="text" class="form-control" name="pangkat"  required>
                                <option disabled selected value> -- select an option -- </option>
                                <option value="perwira">Perwira</option>
                                <option value="penata muda">Penata Muda</option>
                                <option value="pengatur tingkat I">Pengatur Tingkat I</option>

                              </select>
                               </div>
                      </div>
                    </div>
                

                <div class="form-group">
                   <div class="form-row">
                  <div class="col-md-6">
                    <label for="password">{{__('Password')}}</label>
                    <input id="password" type="password" class="form-control" name="password" maxlength="25" required>
                                    
                </div>
              <div class="col-md-6">
		            <label for="password-confirm">{{__('Confirm Password')}}</label>
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

