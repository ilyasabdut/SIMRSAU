@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Penyakit</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.penyakit')}}">Penyakit</a>
        </li>
        <li class="breadcrumb-item active">Import Export</li>
      </ol>
       @if(session('info'))
                          <div class="alert alert-success">
                      {{session('info')}}
                          </div>
                    @endif
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Import/Export Penyakit            
        </div>
        <div class="card-body">
          
           <a href="{{ URL::to('/admin/penyakit/exportpenyakit/xls') }}"><button class="btn btn-success">Export Excel xls</button></a>
           <a href="{{ URL::to('/admin/penyakit/exportpenyakit/xlsx') }}"><button class="btn btn-success">Export Excel xlsx</button></a>
           <a href="{{ URL::to('/admin/penyakit/exportpenyakit/csv') }}"><button class="btn btn-success">Export CSV</button></a>

           <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
             action="{{ route('admin.importpenyakit')}}"     class="form-horizontal" method="post"
             enctype="multipart/form-data">

              {!! csrf_field() !!}
               <p style="color: red">{{$errors->first('import_file')}}</p>



                <input type="file" name="import_file" />
             <button class="btn btn-primary">Import File</button>
              <a  class="btn btn-secondary" href="javascript:history.back()">
                                    {{ __('Back') }}
                                </a>

              </form>



        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
 @include('inc.footerauth')





