@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Penyakit</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.penyakit')}}">Penyakit</a>
        </li>
        <li class="breadcrumb-item active">Sunting</li>
      </ol>
      <!-- Example DataTables Card-->
    <div class="card card-register mx-auto mt-5">
		<div class="card-header">
		    <div class="row">
	          <div class="col-sm-9">
	           <i class="fa fa-table"></i> Sunting Penyakit
	          </div>    
	      	</div>
        </div>
		        
                <div class="card-body">
                    <form method="POST" action="{{url('/admin/penyakit/edit',array($data->id))}}">
                        @csrf    

					   <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama_penyakit">{{ __('Nama Penyakit') }}</label>
                           <input id="nama_penyakit" type="text" class="form-control" name="nama_penyakit" value="<?php echo $data->nama_penyakit; ?>" required>          
                              </div>
                              
                         <div class="col-md-6">
                        <label for="kd_penyakit">{{__('Kode penyakit')}}</label>
                         <input id="kd_penyakit" type="kd_penyakit" class="form-control" name="kd_penyakit" value="<?php echo $data->kd_penyakit; ?>" required>
                               </div>
                      </div>
                    </div>

        

			        
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

