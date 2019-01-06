@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} -  Tambah Penyakit</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Tambah Penyakit</a>
        </li>
       
      </ol>
      <!-- Example DataTables Card-->
    <div class="card card-register mx-auto mt-5">
		        <div class="card-header">
		           <div class="row">
		              <div class="col-sm-9">
		                <i class="fa fa-table"></i> Tambah Penyakit
		              </div>    
  		      	</div>
  		      </div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.penyakit.insert')}}">
                        @csrf
					           <div class="form-group">
                   <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama_penyakit">{{ __('Nama Penyakit') }}</label>
                           <input id="nama_penyakit" type="text" class="form-control{{ $errors->has('nama_penyakit') ? ' is-invalid' : '' }}" name="nama_penyakit" maxlength="25" required>  
                             @if ($errors->has('nama_penyakit'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_penyakit') }}</strong>
                                                </span>
                                            @endif       
                              </div>
                              
                         <div class="col-md-6">
                        <label for="kd_penyakit">{{__('Kode Penyakit')}}</label>
                         <input id="kd_penyakit" type="kd_penyakit" class="form-control{{ $errors->has('kd_penyakit') ? ' is-invalid' : '' }}" name="kd_penyakit" maxlength="5"  required>
                          @if ($errors->has('kd_penyakit'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('kd_penyakit') }}</strong>
                                                </span>
                                            @endif
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

