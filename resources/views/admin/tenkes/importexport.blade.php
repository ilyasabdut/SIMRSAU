@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Dokter</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.tenkes')}}">Tenaga Kesehatan</a>
        </li>
        <li class="breadcrumb-item active">Import Export</li>
      </ol>
       @if(session('info'))
                          <div class="alert alert-success">
                      {{session('info')}}
                          </div>
                    @endif

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Import/Export Dokter dan Tenaga Kesehatan                        
        </div>

        <div class="card-body">
          
           <a href="{{ URL::to('/admin/tenkes/exporttenkes/xls') }}"><button class="btn btn-success">Export Excel xls</button></a>
           <a href="{{ URL::to('/admin/tenkes/exporttenkes/xlsx') }}"><button class="btn btn-success">Export Excel xlsx</button></a>
           <a href="{{ URL::to('/admin/tenkes/exporttenkes/csv') }}"><button class="btn btn-success">Export CSV</button></a>

           <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
             action="{{ route('admin.importtenkes')}}"     class="form-horizontal" method="post"
             enctype="multipart/form-data">

              {!! csrf_field() !!}
              Import Data untuk otentifikasi
               <p style="color: red">{{$errors->first('import_file')}}</p>
                <input type="file" name="import_file" />
             <button class="btn btn-primary">Import File</button>
              </form>

            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
             action="{{ route('admin.importtenkes2')}}"     class="form-horizontal" method="post"
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
                                    {{ __('Back') }}
                                </a>
                            </div>
                      </div>      
      </div>
    </div>
   
 @include('inc.footerauth')





