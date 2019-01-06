@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} -  Tambah Obat</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Tambah Obat</a>
        </li>       
      </ol>
       @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif
    <div class="card card-register mx-auto mt-5">

		        <div class="card-header">

		           <div class="row">
		              <div class="col-sm-9">
		                <i class="fa fa-table"></i> Tambah Obat
		              </div>    
  		      	</div>
  		      </div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.obat.insert')}}">
                        @csrf
					           <div class="form-group">
                   <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama_obat">{{ __('Nama Obat') }}</label>
                           <input id="nama_obat" type="text" class="form-control{{ $errors->has('nama_obat') ? ' is-invalid' : '' }}" name="nama_obat" maxlength="25" required>  
                             @if ($errors->has('nama_obat'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('nama_obat') }}</strong>
                                                </span>
                                            @endif       
                              </div>
                              
                         <div class="col-md-6">
                        <label for="kd_obat">{{__('Kode Obat')}}</label>
                         <input id="kd_obat" type="kd_obat" class="form-control{{ $errors->has('kd_obat') ? ' is-invalid' : '' }}" name="kd_obat" maxlength="5"  required>
                          @if ($errors->has('kd_obat'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('kd_obat') }}</strong>
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

