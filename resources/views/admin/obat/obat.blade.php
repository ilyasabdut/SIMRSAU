@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Obat</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.obat')}}">Daftar</a>
        </li>
        <li class="breadcrumb-item active">Obat</li>
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
                    <i class="fa fa-table"></i> Daftar Obat
                  </div>    
                  <div class="col-md-4 text-right">
                    <a href='{{url("admin/obat/tambah")}}'>
                    <button  class="btn btn-primary btn-sm">Tambah Obat</button>  
                    </a>

                    <a href='{{url("admin/obat/importexport")}}'>
                    <button class="btn btn-success btn-sm" >Impor/Ekspor</button>  
                    </a>
                  </div>
               </div>
               
            </div>
         

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataPenyakit" width="100%" cellspacing="0">
              
              <thead>
                <tr>
                  <th>Kode Obat</th>
                  <th>Nama Obat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
             
              <tbody>

               @if(count($data)>0)
                 @foreach ($data as $dat)
              <tr>
                <td>{{$dat->kd_obat}}</td>
                <td>{{$dat->nama_obat}}</td>
                 <td>
                  
                  <a title="edit" class="btn btn-success btn-sm" href='{{url("/admin/obat/update/{$dat->id}")}}' aria-label="edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                   <a title="Delete" class="btn btn-danger btn-sm" href='{{url("/admin/obat/delete/{$dat->id}")}}' aria-label="Delete">
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

