<!DOCTYPE html>
<html>
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <img class="img" src="img/logos/footer.png" alt="">
    <hr>
    <style type="text/css">
      table {
         border-collapse: collapse;
      }
      table, th, td {

          border: 1px solid black;
      }
      th, td {
          padding: 5px;
          text-align: left;
        }
    </style>
  </head>

  <body>
    <div class="form-group">
              <div class="row">
                 @foreach ($rm as $dat)

                 <table style="width:50%">
                    <caption>
                      <h2>Profil Pasien</h2>
                    </caption>

                  <tr>
                    <th>Nama Lengkap</th>
                    <td>{{$dat->nama_pasien}} </td>
                  </tr>

                  <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{Date::createFromFormat('Y-m-d',$dat->tgl_lahir)->format('d-F-Y')}}</td>
                  </tr>
                  <tr>
                    <th>NIK</th>
                    <td>{{$dat->NIK}}</td>
                  </tr>
                   <tr>
                    <th>Nomor Telepon</th>
                    <td>{{$dat->no_telp}}</td>
                  </tr>
                   <tr>
                    <th>No Rekam Medis</th>
                    <td>{{$dat->no_rm}}</td>
                  </tr>
                   <tr>
                    <th>Golongan Darah</th>
                    <td>{{$dat->gol_darah}}</td>
                  </tr>
                   <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{$dat->jenis_kelamin}}</td>
                  </tr>
                </table>
          

            </div>
          </div>


                  <h2 style="text-align: center;">Rekam Medis Pasien </h2>  

Tanggal Kunjungan: {{Date::createFromFormat('Y-m-d H:i:s',$dat->tgldtg)->format('l, d-F-Y')}}
<br>
<br>     
                     

        
         <div class="form-group">
              <div class="row">

                 <table style="width:100%">

                  <tr>
                    <th>Nama Dokter</th>
                    <td>{{$dat->nama_dokter}} </td>
                  </tr>
                  <tr>
                    <th>Nama Perawat</th>
                    <td>{{$dat->nama_perawat}} </td>
                  </tr>
                  <tr>
                    <th>Keluhan</th>
                    <td>{{$dat->keluhan}}</td>
                  </tr>
                  <tr>
                    <th>Nama Penyakit</th>
                    <td>{{$dat->nama_penyakit}} </td>
                  </tr>
                  <tr>
                    <th>Nama Obat</th>
                    <td>{{$dat->nama_obat}}</td>
                  </tr>
                   <tr>
                    <th>Catatan Dokter</th>
                    <td>{{$dat->catatan_dokter}}</td>
                  </tr>
                </table>
          
                      @endforeach

            </div>
          </div>
            
  </body>
</html>