@include('inc.header')

<title>{{ env('APP_NAME') }} - Beranda</title> 

    <!-- Header -->
    <header class="masthead" id="home">
      <div class="container">
        <div class="intro-text">
          @guest
                    <div class="intro-lead-in">Selamat datang!</div>
          @else
          <div class="intro-lead-in">Selamat datang 
              <pre> {{ Auth::user()->nama }}!</pre>
          </div>
          @endguest
          <div class="intro-heading">Semoga Lekas Sembuh </div>

        </div>
      </div>
    </header>

    <!-- Services -->
    <section class="bg-light" id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Layanan Kami</h2>
            <h3 class="section-subheading text-muted">Siap Siaga Selalu</h3>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa fa-ambulance fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Layanan Gawat Darurat</h4>
            <p class="text-muted" align="justify">Beroperasi 24 Jam. Dokter dan perawat-perawat profesional kami siap sedia memberikan pertolongan segera untuk mengatasi kasus gawat darurat.           </p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa fa-desktop fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Touchscreen Antrian</h4>
            <p class="text-muted" align="justify">Adanya sistem antrian elektronik meminimalkan ketidaknyamanan dalam antrian. Keramahtamahan petugas pendaftaran memudahkan Anda dalam menentukan layanan yang diinginkan.</p>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa fa-hospital-o fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">Fasilitas Rawat Inap</h4>
            <p class="text-muted" align="justify">Berbagai jenis perawatan kami siapkan sehingga memudahkan pasien untuk memilih jenis ruang rawat yang diinginkan seperti: Super VIP, VIP, Kelas I, Kelas II, Kelas III.
              </p>
          </div>
        </div>
      </div>
    </section>

   

  <!-- Maps -->
    <section class="bg-light" id="lokasi">
      <div class="container">
         <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Lokasi Kami</h2>
            <h3 class="section-subheading text-muted">Selalu dekat dengan anda</h3>
          </div>
        </div>
    <div class="row">
      <div class="map-frame">
        <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0509165703356!2d106.88954841432071!3d-6.257023263001269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f2df0c7a8435%3A0xfc3149a9df31be66!2sRumah+Sakit+Angkatan+Udara+Dr.+Esnawan+Antariksa!5e0!3m2!1sid!2sid!4v1518145596983">
            </iframe>
              </div>
            </div>
          </div>
    </section>


    
@include('inc.footer')
