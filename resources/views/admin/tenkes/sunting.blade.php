@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Tenaga Kesehatan</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.tenkes')}}">Tenaga Kesehatan</a>
        </li>
        <li class="breadcrumb-item active">Sunting</li>
      </ol>
      <!-- Example DataTables Card-->
    <div class="card card-register mx-auto mt-5">
		<div class="card-header">
		    <div class="row">
	          <div class="col-sm-9">
	           <i class="fa fa-table"></i> Sunting Tenaga Kesehatan
	          </div>    
	      	</div>
        </div>
		         @if(count($data)>0)
                 @foreach ($data as $dat)

                <div class="card-body">
                    <form method="POST" action="{{url('/admin/tenkes/edit',array($dat->id))}}">
                        @csrf    

					   <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama">{{ __('Nama Lengkap') }}</label>
                           <input id="nama" type="text" class="form-control" name="nama" value="<?php echo $dat->nama; ?>" required>          
                              </div>
                              
                         <div class="col-md-6">
                        <label for="kd_dokter">{{__('Kode Dokter')}}</label>
                         <input id="kd_dokter" type="kd_dokter" class="form-control" name="kd_dokter" value="<?php echo $dat->kd_dokter; ?>" required>
                               </div>
                      </div>
                    </div>

          <div class="form-group">
                     <div class="form-row">
                       <div class="col-md-12">
                        <label for="NIK">{{ __('NIK') }}</label>
                           <input id="NIK" type="text" class="form-control" name="NIK" value="<?php echo $dat->NIK; ?>" required>          
                              </div>
                          </div>
           </div>
                  

                <div class="form-group">
                  <div class="form-row">
                      <div class="col-md-6">
                        <label for="email">{{__('E-Mail')}}</label>
                         <input id="email" type="email" class="form-control" name="email" value="<?php echo $dat->email; ?>" required>
                               </div>
                              
                        <div class="col-md-6">
                  <label for="level">{{__('Level')}}</label>
                   <select id="level" class="form-control" name="level" required>

                    <option value="Admin"  @if(old('level') == 'Admin')selected @endif>Admin</option>
                    <option value="Pasien" @if(old('level') == 'Pasien')selected @endif>Pasien</option>
                    <option value="Dokter" @if(old('level') == 'Dokter')selected @endif>Dokter</option>
                    <option value="perawat" @if(old('level') == 'perawat')selected @endif>Perawat</option>
                    <option value="Resepsionis" @if(old('level') == 'Resepsionis')selected @endif>Resepsionis</option>
       
                    </select>
                     @if ($errors->has('level'))
                                          <span class="invalid-feedback">
                                              <strong>{{ $errors->first('level') }}</strong>
                                          </span>
                                      @endif
                 </div>
              </div>
              </div>  

			           <div class="form-group">
			              <div class="form-row">
			                  <div class="col-md-6">
			                      <label for="bidang">{{__('Bidang')}}</label>
			                        <select id="bidang" class="form-control" name="bidang" required>
			                                <option value="perawat radiologi" >Perawat Radiologi</option>
                                      <option value="perawat penyakit dalam" >Perawat Penyakit Dalam</option>
			                                <option value="resepsionis" >Resepsionis</option>
                   
                              </select>
                                            @if ($errors->has('bidang'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('bidang') }}</strong>
                                                </span>
                                            @endif
                                </div>

                          <div class="col-md-6">
                            <label for="pangkat">{{__('Pangkat')}}</label>
                            <select id="pangkat" type="text" class="form-control" name="pangkat"  required>
                                <option value="Perwira" @if(old('pangkat') == 'Perwira')selected @endif>Perwira</option>
                                <option value="Penata Muda" @if(old('pangkat') == 'Penata Muda')selected @endif>Penata Muda</option>
                                <option value="Pengatur Tingkat I" @if(old('pangkat') == 'Pengatur Tingkat I')selected @endif>Pengatur Tingkat I</option>

                              </select>
                          </div>
                      </div>
                    </div>

			          <div class="form-group">
			             <div class="form-row">
				          <div class="col-md-6">
				            <label for="password">{{__('Password')}}</label>
				            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
			                                @if ($errors->has('password'))
			                                    <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('password') }}</strong>
			                                    </span>
			                                @endif
				          				</div>
			              <div class="col-md-6">
					            <label for="password-confirm">{{__('Confirm Password')}}</label>
					            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
			              </div>
			          </div>
			        </div>

			         @endforeach
                @endif
        	 			<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Sunting') }}
                                </button>
                                <a  class="btn btn-secondary" href="javascript:history.back()">
                                    {{ __('Back') }}
                                </a>
                            </div>
                   		</div>
        			</form>
     		 	</div>
		      </div>
		    </div>
		</div>
    
 @include('inc.footerauth')

