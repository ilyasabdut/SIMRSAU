@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Penyakit</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.penyakit')}}">Daftar</a>
        </li>
        <li class="breadcrumb-item active">Penyakit</li>
      </ol>
       @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif

      <div class="card mb-3">
        <div class="card-header">
         
           <div class="form-group row mb-0">
                  <div class="col-md-8">
                    <i class="fa fa-table"></i> Daftar penyakit
                  </div>    
                  <div class="col-md-4 text-right">
                    <a href='{{url("admin/penyakit/tambah")}}'>
                    <button  class="btn btn-primary btn-sm">Tambah Penyakit</button>  
                    </a>

                    <a href='{{url("admin/penyakit/importexport")}}'>
                    <button class="btn btn-success btn-sm" >Impor/Ekspor</button>  
                    </a>
                  </div>
               </div>
               
            </div>
         

        <div class="card-body">
          <div class="table responsive">
            <table class="table table-bordered" id="dataPenyakit" width="100%" cellspacing="0">
              <col width="20%">
               <col width="60%">
                <col width="20%">
              <thead>
                <tr>
                  <th>Kode Penyakit</th>
                  <th>Nama Penyakit</th>
                  <th>Aksi</th>
                </tr>
              </thead>
             
              <tbody>

               @if(count($data)>0)
                 @foreach ($data as $dat)
              <tr>
                <td>{{$dat->kd_penyakit}}</td>
                <td>{{$dat->nama_penyakit}}</td>
                 <td>
                  
                  <a title="edit" class="btn btn-success btn-sm" href='{{url("/admin/penyakit/update/{$dat->id}")}}' aria-label="edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                   <a title="Delete" class="btn btn-danger btn-sm" href='{{url("/admin/penyakit/delete/{$dat->id}")}}' aria-label="Delete">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a>

                </td>
            </tr>
               @endforeach
            @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
   
 @include('inc.footerauth')

