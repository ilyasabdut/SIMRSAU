@include('inc.headerauth')
     <title>{{ env('APP_NAME') }} - Tenaga Kesehatan</title> 

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('admin.tenkes')}}">Daftar</a>
        </li>
        <li class="breadcrumb-item active">Tenaga Kesehatan</li>
      </ol>
        @if(session('info'))
                  <div class="alert alert-success">
                  {{session('info')}}
                  </div>
                  @endif
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <div class="form-group row mb-0">
                  <div class="col-md-8">
                    <i class="fa fa-table"></i> Daftar Tenaga Kesehatan Hadir
                  </div>    
                  <div class="col-md-4 text-right">
                    <a href='{{url("admin/tenkes/tambah")}}'>
                    <button  class="btn btn-primary btn-sm">Tambah</button>  
                    </a>

                    <a href='{{url("admin/tenkes/importexport")}}'>
                    <button class="btn btn-success btn-sm" >Impor/Ekspor</button>  
                    </a>
                  </div>
               </div>
              
            </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="dataTables table table-bordered" id="" width="100%" cellspacing="0" >
              <thead>
                <tr>
                  <th>Kode Dokter</th>
                  <th>Nama </th>
                  <th>Profesi</th>
                  <th>Status</th>
                  <th>Aksi</th>

                </tr>
              </thead>
             
              <tbody>

               @if(count($data)>0)
                 @foreach ($data as $dat)
                     @if($dat->status == 'hadir')
              <tr>
                <td>{{$dat->kd_dokter}}</td>
                <td>{{$dat->nama}}</td>
                <td>{{$dat->bidang}}</td>
                <td>{{$dat->status}}</td>
                 <td>
                               <div class="btn-group">

                  <a title="edit" class="btn btn-success btn-sm" href='{{url("/admin/tenkes/update/{$dat->id}")}}' aria-label="edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                  <a title="read" class="btn btn-primary btn-sm" href='{{url("/admin/tenkes/read/{$dat->id}")}}' aria-label="read">
                    <i class="fa fa-book" aria-hidden="true"></i>
                  </a>
                   <a title="Delete" class="btn btn-danger btn-sm" href='{{url("/admin/tenkes/delete/{$dat->id}")}}' aria-label="Delete">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a>
                  </div> 
                  <div class="btn-group">

                      <form action="{{url('/admin/tenkes/tenkesstatus',array($dat->id))}}" method="POST">
                        @csrf
                               <button type="submit" class="btn btn-sm btn-danger" title="tidak hadir" aria-label="tidak hadir">
                                          <i class="fa fa-ban" aria-hidden="true"></i> 
                                 </button>
                       </form>
              </div>

                </td>
            </tr>
                @endif
               @endforeach
            @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>


    <div class="card mb-3">
        <div class="card-header">
          <div class="form-group row mb-0">
                  <div class="col-md-8">
                    <i class="fa fa-table"></i> Daftar Tenaga Kesehatan Tidak Hadir
                  </div>    
               </div>
            </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="dataTables table table-bordered" id="" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Kode Dokter</th>
                  <th>Nama </th>
                  <th>Profesi</th>
                  <th>Status</th>
                  <th>Action</th>

                </tr>
              </thead>
             
              <tbody>

               @if(count($data)>0)
                 @foreach ($data as $dat)
                  @if($dat->status == 'tidak hadir')
              <tr>
                <td>{{$dat->kd_dokter}}</td>
                <td>{{$dat->nama}}</td>
                <td>{{$dat->bidang}}</td>
                <td>{{$dat->status}}</td>
                 <td>
                  <div class="btn-group">

                  <a title="edit" class="btn btn-success btn-sm" href='{{url("/admin/tenkes/update/{$dat->id}")}}' aria-label="edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                  <a title="read" class="btn btn-primary btn-sm" href='{{url("/admin/tenkes/read/{$dat->id}")}}' aria-label="read">
                    <i class="fa fa-book" aria-hidden="true"></i>
                  </a>
                   <a title="Delete" class="btn btn-danger btn-sm" href='{{url("/admin/tenkes/delete/{$dat->id}")}}' aria-label="Delete">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a> </div> 
                  <div class="btn-group">

                   <form action="{{url('/admin/tenkes/tenkesstatus2',array($dat->id))}}" method="POST">
                        @csrf
                               <button type="submit" class="btn btn-sm btn-success" title="hadir" aria-label="ditolak"> 
                                          <i class="fa fa-check" aria-hidden="true"></i> 
                                 </button>
                       </form>
                     </div>
                </td>
            </tr>
                @endif
               @endforeach
            @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
   
 @include('inc.footerauth')

