@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Tenaga Kesehatan</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.tenkes')}}">Tenaga Kesehatan</a>
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
                    <i class="fa fa-table"></i> Detail Tenaga Kesehatan
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
                        <label for="nama">{{ __('Nama Lengkap') }}</label>
                           <input id="nama" type="text" class="form-control" name="nama" value="<?php echo $dat->nama; ?>" readonly="readonly">          
                              </div>
                              
                         <div class="col-md-6">
                        <label for="kd_dokter">{{__('Kode Dokter')}}</label>
                         <input id="kd_dokter" type="kd_dokter" class="form-control" name="kd_dokter" value="<?php echo $dat->kd_dokter; ?>" readonly="readonly">
                               </div>
                      </div>
                    </div>

          <div class="form-group">
                     <div class="form-row">
                       <div class="col-md-12">
                        <label for="NIK">{{ __('NIK') }}</label>
                           <input id="NIK" type="text" class="form-control" name="NIK" value="<?php echo $dat->NIK; ?>" readonly="readonly">          
                              </div>
                          </div>
           </div>
                  

                <div class="form-group">
                  <div class="form-row">
                      <div class="col-md-6">
                        <label for="email">{{__('E-Mail')}}</label>
                         <input id="email" type="email" class="form-control" name="email" value="<?php echo $dat->email; ?>" readonly="readonly">
                               </div>
                              
                         <div class="col-md-6">
                        <label for="level">{{__('Level')}}</label>
                         <input id="level" type="level" class="form-control" name="level" value="<?php echo $dat->level; ?>" readonly="readonly">
                               </div>
                              </div>
                         </div>     

           <div class="form-group">
                         <div class="form-row">
                        <div class="col-md-6">
                          <label for="bidang">{{__('Bidang Profesi')}}</label>
                          <input id="bidang" type="text" class="form-control" value="<?php echo $dat->bidang; ?>" name="bidang" readonly="readonly">
                                </div>

                          <div class="col-md-6">
                            <label for="pangkat">{{__('Pangkat')}}</label>
                            <input id="pangkat" type="text" class="form-control" name="pangkat" value="<?php echo $dat->pangkat; ?>" readonly="readonly">
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

