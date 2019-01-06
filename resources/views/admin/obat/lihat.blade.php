@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Obat</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.obat')}}">Obat</a>
        </li>
        <li class="breadcrumb-item active">Detail</li>
      </ol>
        @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif
    <div class="card card-register mx-auto mt-5">
         <div class="card-header">
                <div class="form-group row mb-0">
                  <div class="col-md-10">
                    <i class="fa fa-table"></i> Detail Obat
                  </div>           
               </div>
               </div>

               @if(count($data)>0)
                 @foreach ($data as $dat)
             
        
        <div class="card-body">
          <form>

             <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama_obat">{{ __('Nama Obat') }}</label>
                           <input id="nama_obat" type="text" class="form-control" name="nama_obat" value="<?php echo $dat->nama_obat; ?>" readonly="readonly">          
                              </div>
                              
                         <div class="col-md-6">
                        <label for="kd_obat">{{__('Kode Obat')}}</label>
                         <input id="kd_obat" type="kd_obat" class="form-control" name="kd_obat" value="<?php echo $dat->kd_obat; ?>" readonly="readonly">
                               </div>
                      </div>
                    </div>

                @endforeach
                @endif
                         <div class="form-group">
                            <div class="text-center">
                                <a  class="btn btn-secondary" href="javascript:history.back()">
                                    {{ __('Back') }}
                                </a>
                            </div>
                      </div>           
        </form>

        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    
 @include('inc.footerauth')

