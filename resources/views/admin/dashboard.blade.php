@include('inc.headerauth')
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Halaman Utama</a>
        </li>
        <li class="breadcrumb-item active">Halaman Utama Admin </li>
      </ol>
     <title>{{ env('APP_NAME') }} - Halaman Utama Admin</title> 
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <div class="row">

        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users"></i>
              </div>
              <div class="mr-5">{{ count(DB::table('tb_user')
                ->where('tb_user.level', '=', 'pasien')
                ->get())}} Pasien</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('admin.pasien')}}">
              <span class="float-left">Lihat Detail</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>


        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-hospital-o"></i>
              </div>
          <div class="mr-5">{{ count(DB::table('tb_user')
                ->where('tb_user.level', '=', 'dokter')
                ->get())}} Dokter
            </div>
            </div>        
             <a class="card-footer text-white clearfix small z-1" href="{{route('admin.tenkes')}}">
              <span class="float-left">Lihat Detail</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-xl-4 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-ambulance"></i>
              </div>
              <div class="mr-5">
                {{ count(DB::table('tb_user')
                ->where('tb_user.level', '=', 'perawat')
                ->orWhere('tb_user.level', '=', 'resepsionis')
                ->get())}} 
              Tenaga Kesehatan </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('admin.tenkes')}}">
              <span class="float-left">Lihat Detail</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-medkit"></i>
              </div>
              <div class="mr-5">
                {{ count(DB::table('tb_penyakits')->get())}}  
              Penyakit</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('admin.penyakit')}}">
              <span class="float-left">Lihat Detail</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-flask"></i>
              </div>
              <div class="mr-5">
                {{ count(DB::table('tb_obats')->get())}}  
                  Obat</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('admin.obat')}}">
              <span class="float-left">Lihat Detail</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        
      </div>
    </div>
        </div>
      </div>
      
   
  @include('inc.footerauth')
