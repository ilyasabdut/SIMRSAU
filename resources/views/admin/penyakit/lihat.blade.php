@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - penyakit</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.penyakit')}}">Penyakit</a>
        </li>
        <li class="breadcrumb-item active">Detail</li>
      </ol>
      <!-- Example DataTables Card-->
    <div class="card card-register mx-auto mt-5">

         <div class="card-header">

                <div class="form-group row mb-0">
                  <div class="col-md-10">
                    <i class="fa fa-table"></i> Detail Penyakit
                  </div>    
                  
               </div>
                @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif
               </div>
{{dd($data)}}
               @if(count($data)>0)
                 @foreach ($data as $dat)
             
        
        <div class="card-body">
          <form>

             <div class="form-group">
                 <div class="form-row">
                       <div class="col-md-6">
                        <label for="nama_penyakit">{{ __('Nama Penyakit') }}</label>
                           <input id="nama_penyakit" type="text" class="form-control" name="nama_penyakit" value="{{$dat->nama_penyakit}}" readonly="readonly">          
                              </div>
                              
                         <div class="col-md-6">
                        <label for="kd_penyakit">{{__('Kode Penyakit')}}</label>
                         <input id="kd_penyakit" type="kd_penyakit" class="form-control" name="kd_penyakit" value="<?php echo $dat->kd_penyakit; ?>" readonly="readonly">
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
      </div>
    </div>
    
 @include('inc.footerauth')

