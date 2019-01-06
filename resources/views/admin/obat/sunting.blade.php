@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Obat</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.obat')}}">Obat</a>
        </li>
        <li class="breadcrumb-item active">Sunting</li>
      </ol>
      
    <div class="card card-register mx-auto mt-5">
		<div class="card-header">
		    <div class="row">
	          <div class="col-sm-9">
	           <i class="fa fa-table"></i> Sunting Obat
	          </div>    
	      	</div>
        </div>
		       

                <div class="card-body">
                    <form method="POST" action="{{url('/admin/obat/edit',array($data->id))}}">
                        @csrf    

					   <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama_obat">{{ __('Nama Obat') }}</label>
                           <input id="nama_obat" type="text" class="form-control" name="nama_obat" value="<?php echo $data->nama_obat; ?>" required>          
                              </div>
                              
                         <div class="col-md-6">
                        <label for="kd_obat">{{__('Kode Obat')}}</label>
                         <input id="kd_obat" type="kd_obat" class="form-control" name="kd_obat" value="<?php echo $data->kd_obat; ?>" required>
                               </div>
                      </div>
                    </div>


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

