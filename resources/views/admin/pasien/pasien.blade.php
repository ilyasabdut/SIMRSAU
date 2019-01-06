@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Pasien</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.pasien')}}">Daftar</a>
        </li>
        <li class="breadcrumb-item active">Pasien</li>
      </ol>
      <!-- Example DataTables Card-->

         @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif
                  
      <div class="card mb-3">

         <div class="card-header">

                <div class="form-group row mb-0">
                  <div class="col-md-8">
                    <i class="fa fa-table"></i> Daftar Pasien
                  </div>    
                  <div class="col-md-4 text-right">
                    <a href='{{url("admin/pasien/tambah")}}'>
                    <button  class="btn btn-primary btn-sm">Tambah Pasien</button>  
                    </a>

                    <a href='{{url("admin/pasien/importexport")}}'>
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
                  <th>Nomor Rekam Medis</th>
                  <th>Nama </th>
                  <th>E-mail</th>
                  <th>NIK</th>
                  <th>Aksi</th>
                 <!--  <th>Status</th>
                  <th>Rekam Medis</th> -->
                </tr>
              </thead>
             
              <tbody>

               @if(count($data)>0)
                 @foreach ($data as $dat)
              <tr>
                <td>{{$dat->no_rm}}</td>
                <td>{{$dat->nama}}</td>
                <td>{{$dat->email}}</td>
                <td>{{$dat->NIK}}</td>
                <td>
                  
                  <a title="edit" class="btn btn-success btn-sm" href='{{url("/admin/pasien/update/{$dat->id}")}}' aria-label="edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                  <a title="read" class="btn btn-primary btn-sm" href='{{url("/admin/pasien/read/{$dat->id}")}}' aria-label="read">
                    <i class="fa fa-book" aria-hidden="true"></i>
                  </a>
                   <a title="Delete" class="btn btn-danger btn-sm" href='{{url("/admin/pasien/delete/{$dat->id}")}}' aria-label="Delete">
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

