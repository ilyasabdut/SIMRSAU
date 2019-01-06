@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Pasien</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.pasien')}}">Pasien</a>
        </li>
        <li class="breadcrumb-item active">Impor Ekspor</li>
      </ol>
          @if(session('info'))
                          <div class="alert alert-success">
                      {{session('info')}}
                          </div>
                    @endif      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Impor/Ekspor Pasien

                        

        </div>

        <div class="card-body">
          
           <a href="{{ URL::to('/admin/pasien/exportpasien/xls') }}"><button class="btn btn-success">Ekspor Excel xls</button></a>
           <a href="{{ URL::to('/admin/pasien/exportpasien/xlsx') }}"><button class="btn btn-success">Ekspor Excel xlsx</button></a>
           <a href="{{ URL::to('/admin/pasien/exportpasien/csv') }}"><button class="btn btn-success">Ekspor CSV</button></a>

           <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
             action="{{ route('admin.importpasien')}}"     class="form-horizontal" method="post"
             enctype="multipart/form-data">
             Import Data Otentifikasi

              {!! csrf_field() !!}
               <p style="color: red">{{$errors->first('import_file')}}</p>
                <input type="file" name="import_file" />
                     <button class="btn btn-primary">Import File</button>

              </form>

                <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
             action="{{ route('admin.importpasien2')}}"     class="form-horizontal" method="post"
             enctype="multipart/form-data">
             Import Data Personal
              {!! csrf_field() !!}
               <p style="color: red">{{$errors->first('import_file2')}}</p>
                <input type="file" name="import_file2" />
             <button class="btn btn-primary">Import File</button>
              </form>


        </div>
        <div class="form-group">
                            <div class="text-center">
                                <a  class="btn btn-secondary" href="javascript:history.back()">
                                    {{ __('Kembali') }}
                                </a>
                            </div>
                      </div>      
      </div>
    </div>
    
 @include('inc.footerauth')





