@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Pasien</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.pasien')}}">Pasien</a>
        </li>
        <li class="breadcrumb-item active">Sunting</li>
      </ol>
      <!-- Example DataTables Card-->
    <div class="card card-register mx-auto mt-5">
		<div class="card-header">
		    <div class="row">
	          <div class="col-sm-9">
	           <i class="fa fa-table"></i> Sunting Pasien
	          </div>    
	      	</div>
        </div>
		        
		          @if(count($data)>0)
                 @foreach ($data as $dat)

                <div class="card-body">
                    <form method="POST" action="{{url('/admin/pasien/edit',array($dat->id))}}">
                        @csrf      

			           <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama">{{ __('Nama Lengkap') }}</label>
                           <input id="nama" type="text" class="form-control" name="nama" maxlength="25" value="<?php echo $dat->nama; ?>"  required>  
                               
                              </div>
                              
                         <div class="col-md-6">
                        <label for="no_rm">{{__('No Rekam Medis')}}</label>
                         <input id="no_rm" type="no_rm" class="form-control" name="no_rm" maxlength="5" value="<?php echo $dat->no_rm; ?>" required>
                         
                        </div>
                      </div>
                    </div>
                  
                <div class="form-group">
                  <div class="form-row">
                      <div class="col-md-6">
                        <label for="email">{{__('E-Mail')}}</label>
                         <input id="email" type="email" class="form-control" name="email" maxlength="25" value="<?php echo $dat->email; ?>" required>
                              
                               </div>
                              
                         <div class="col-md-6">
                 <label for="NIK">{{ __('NIK') }}</label>
                           <input id="NIK" type="text" class="form-control" name="NIK" maxlength="16" value="<?php echo $dat->NIK; ?>" required> 
                     
                                 </div>
                              </div>
                          </div>

               <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="jenis_kelamin">{{__('Jenis Kelamin')}}</label>
                              <select id="jenis_kelamin" type="text" class="form-control"  name="jenis_kelamin" value="<?php echo $dat->jenis_kelamin; ?>"  required>

                                <option value="Laki-Laki" 
                                 @if(old('jenis_kelamin') == 'Laki_Laki')selected @endif>
                             		Laki-Laki </option>
                                <option value="Perempuan" 
                                 @if(old('jenis_kelamin') == 'Perempuan')selected @endif>
                             		Perempuan</option>

                              </select>             
                          </div>

                          <div class="col-md-6">
                            <label for="tgl_lahir">{{__('Tanggal Lahir')}}</label>
                            <input id="tgl_lahir" type="date" class="form-control" name="tgl_lahir" maxlength="20" value="<?php echo $dat->tgl_lahir; ?>" required>
                              
				                          </div>
				                      </div>
				                    </div>

                     <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="gol_darah">{{__('Golongan Darah')}}</label>
                              <select id="gol_darah" type="text" class="form-control"  name="gol_darah" value="<?php echo $dat->gol_darah; ?>" required>

                                <option value="A"  @if(old('gol_darah') == 'A')selected @endif>A</option>
                                <option value="B" @if(old('gol_darah') == 'B')selected @endif>B</option>
                                <option value="AB" @if(old('gol_darah') == 'AB')selected @endif>AB</option>
                                <option value="O" @if(old('gol_darah') == 'O')selected @endif>O</option>

                              </select>
                                </div>

                          <div class="col-md-6">
                            <label for="no_telp">{{__('Nomor Telepon')}}</label>
                            <input id="no_telp" type="phone" class="form-control" name="no_telp" maxlength="15" value="<?php echo $dat->no_telp; ?>" required>
                             
                          </div>
                      </div>
                    </div>
                <div class="form-group">
                   <div class="form-row">
                  <div class="col-md-12">
                    <label for="alamat">{{__('Alamat')}}</label>
                    <input id="alamat" type="text" class="form-control name="alamat" maxlength="50" value="<?php echo $dat->alamat; ?>" required>
                                     
                   </div>
               </div>
              </div>

                <div class="form-group">
                   <div class="form-row">
                  <div class="col-md-6">
                    <label for="password">{{__('Kata Sandi')}}</label>
                    <input id="password" type="password" class="form-control" name="password" maxlength="25" required>
                                     
                </div>
                      <div class="col-md-6">
        		            <label for="password-confirm">{{__('Konfirmasi Kata Sandi')}}</label>
        		            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" maxlength="25" required>
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

