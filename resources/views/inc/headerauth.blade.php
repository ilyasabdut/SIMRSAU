<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap core CSS-->
  <link href="{{URL::to('/')}}/admin/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="{{URL::to('/')}}/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{URL::to('/')}}/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{URL::to('/')}}/admin/css/sb-admin.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/icon" href="{{URL::to('/')}}/img/logos/logo.png"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-countdown/2.0.2/jquery.countdown.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">   


<script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="{{URL::to('/')}}/admin/js/sb-admin-datatables.js"></script>
    <script src="{{URL::to('/')}}/admin/js/moment.js"></script>
    <script>moment.locale('id');</script>



     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

              <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
     <a class="navbar-brand"><font color="white">    {{ Auth::user()->nama }} 
     </font> 
        </a>
   

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
       



                   @if (Auth::user()->level == 'superadmin')
                       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <a class="nav-link" href="{{route('admin.dashboard')}}">
                          <i class="fa fa-fw fa-dashboard"></i>
                          <span class="nav-link-text">Halaman Utama</span>
                        </a>
                      </li>     
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                      <a class="nav-link" href="{{route('admin.pasien')}}">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Daftar Pasien</span>
                      </a>
                    </li>
                     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                      <a class="nav-link" href="{{route('admin.tenkes')}}">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Daftar Tenaga Kesehatan</span>
                      </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                      <a class="nav-link" href="{{route('admin.penyakit')}}">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Daftar Penyakit</span>
                      </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                      <a class="nav-link" href="{{route('admin.obat')}}">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Daftar Obat</span>
                      </a>
                    </li>

                    @endif

                    @if (Auth::user()->level == 'pasien')
                     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <a class="nav-link" href="{{route('pasien.dashboard')}}">
                          <i class="fa fa-fw fa-dashboard"></i>
                          <span class="nav-link-text">Halaman Utama</span>
                        </a>
                      </li>
                      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                        <a class="nav-link" href="{{route('pasien.daftar')}}">
                          <i class="fa fa-fw fa-area-chart"></i>
                          <span class="nav-link-text">Registrasi Kunjungan</span>
                        </a>
                      </li>
                    @endif

                    @if (Auth::user()->level == 'dokter')
                     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                      <a class="nav-link" href="{{route('dokter.dashboard')}}">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Halaman Utama</span>
                      </a>
                    </li>
                        
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                          <a class="nav-link" href="{{route('dokter.riwayat')}}">
                            <i class="fa fa-fw fa-table"></i>
                            <span class="nav-link-text">Riwayat</span>
                          </a>
                        </li>
                        
                    @endif

                    @if (Auth::user()->level == 'resepsionis')
                       <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                          <a class="nav-link" href="{{route('tenkes.dashboard')}}">
                            <i class="fa fa-fw fa-dashboard"></i>
                            <span class="nav-link-text">Halaman Utama</span>
                          </a>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                          <a class="nav-link" href="{{url('dokter/riwayat')}}">
                            <i class="fa fa-fw fa-table"></i>
                            <span class="nav-link-text">Riwayat</span>
                          </a>
                        </li>
                   @endif

                     @if (Auth::user()->level == 'perawat')
                     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                          <a class="nav-link" href="{{route('tenkes.dashboard')}}">
                            <i class="fa fa-fw fa-dashboard"></i>
                            <span class="nav-link-text">Halaman Utama</span>
                          </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                          <a class="nav-link" href="{{url('dokter/riwayat')}}">
                            <i class="fa fa-fw fa-table"></i>
                            <span class="nav-link-text">Riwayat</span>
                          </a>
                        </li>
                    @endif
                </ul>


      
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      

      <ul class="navbar-nav ml-auto">

          <li class="nav-item">
          <a class="nav-link" href="{{url('/')}}">
            <i class="fa fa-fw fa-home"></i>Beranda</a>
        </li>

         <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  <i class="fa fa-fw fa-user"></i> 
                                  Halo,  {{ Auth::user()->nama }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"  href="\logout" >
                                      <i class="fa fa-fw fa-sign-out"></i>Logout
                                    </a>
                                </div>
                            </li>

      </ul>
    </div>
  </nav>