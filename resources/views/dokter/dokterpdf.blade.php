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
                 @foreach ($profile as $dot)

                 <table style="width:50%">
                    <caption>
                      <h2>Profil Pasien</h2>
                    </caption>

                  <tr>
                    <th>Nama Lengkap</th>
                    <td>{{$dot->nama_pasien}} </td>
                  </tr>

                  <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{Date::createFromFormat('Y-m-d',$dot->tgl_lahir)->format('d-F-Y')}}</td>
                  </tr>
                  <tr>
                    <th>NIK</th>
                    <td>{{$dot->NIK}}</td>
                  </tr>
                   <tr>
                    <th>Nomor Telepon</th>
                    <td>{{$dot->no_telp}}</td>
                  </tr>
                   <tr>
                    <th>No Rekam Medis</th>
                    <td>{{$dot->no_rm}}</td>
                  </tr>
                   <tr>
                    <th>Golongan Darah</th>
                    <td>{{$dot->gol_darah}}</td>
                  </tr>
                   <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{$dot->jenis_kelamin}}</td>
                  </tr>
                </table>
          
                @endforeach

            </div>
          </div>

    <br>  
    <br>
    <table>
                   <caption>
                      <h2>Detail Tindakan Pasien</h2>
                    </caption>
      <thead>
                <tr>
                  <th>Tanggal Kedatangan</th>
                  <th>Dokter </th>
                  <th>Perawat</th>
                  <th>Keluhan</th>
                   <th>Penyakit</th>
                  <th>Obat</th>
                  <th>Catatan Dokter</th>                 
                </tr>
              </thead>
             
              <tbody>

               @if(count($data)>0)
                 @foreach ($data as $dat)
              <tr>
                <td>{{Date::createFromFormat('Y-m-d H:i:s',$dat->updated_at)->format('l, d-F-Y H:i:s')}}</td>
                <td>{{$dat->nama_dokter}}</td>
                <td>{{$dat->nama_perawat}}</td>
                <td>{{$dat->keluhan}}</td>
                <td>{{$dat->nama_penyakit}}</td>
                <td>{{$dat->nama_obat}}</td>
                <td>{{$dat->catatan_dokter}}</td>

            </tr>
          @endforeach
          @endif

              </tbody>
    </table>


  </body>
</html>