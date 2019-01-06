<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" src="{{URL::to('/')}}/img/logos/logo.png"/>
    <link rel="shortcut icon" type="image/icon" href="{{URL::to('/')}}/img/logos/logo.png"/>


    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="{{URL::to('/')}}/css/agency.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/css/services.css" rel="stylesheet">
        <link rel="stylesheet" href="{{URL::to('/')}}/css/maps.css">



  </head>

  <body id="page-top">

     

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"> 
          <img class="img" src="img/logos/logo.png" alt=""> 
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
           <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#home">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Layanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#lokasi">Lokasi</a>
            </li>
           

                  @guest
                     <li class="nav-item">
                       <a class="nav-link js-scroll-trigger" href="/auth/login">Masuk</a>
                    </li>
               
                  @else

                    

                    @if (Auth::User()->level == 'superadmin')
                    <li class="nav-item"><a class="nav-link" href="{{route('admin.dashboard')}}">
                          {{ Auth::User()->level }}</a></li>
                    @endif
                    @if (Auth::user()->level == 'pasien')
                    <li class="nav-item"><a class="nav-link" href="{{route('pasien.dashboard')}}">
                          {{ Auth::user()->level }}</a></li>
                    @endif
                    @if (Auth::user()->level == 'dokter')
                    <li class="nav-item"><a class="nav-link" href="{{route('dokter.dashboard')}}">
                          {{ Auth::user()->level }}</a></li>
                    @endif
                    @if (Auth::user()->level == 'resepsionis')
                    <li class="nav-item"><a class="nav-link" href="{{route('tenkes.dashboard')}}">
                          {{ Auth::user()->level }}</a></li>
                    @endif
                     @if (Auth::user()->level == 'perawat')
                    <li class="nav-item"><a class="nav-link" href="{{route('tenkes.dashboard')}}">
                          {{ Auth::user()->level }}</a></li>
                    @endif

                    @endguest

          </ul>
        </div>

      </div>
    </nav>
