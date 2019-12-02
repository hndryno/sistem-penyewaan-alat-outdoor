<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bukti Pembayaran</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-after: always;
        }
        .bg-grey {
            background: #F3F3F3;
        }
        .text-right {
            text-align: right;
        }

        .w-full {
            width: 100%;
        }

        .small-width {
            width: 15%;
        }
        .invoice {
            background: white;
            border: 1px solid #CCC;
            font-size: 14px;
            padding: 48px;
            margin: 20px 0;
        }
        @media print {
          #printPageButton {
            display: none;
          }
        }
    </style>
</head>
<body class="bg-grey">

  <div class="container container-smaller">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1" style="margin-top:10px; text-align: right">
        <div class="btn-group mb-4">
          <button id="printPageButton" onclick="printme()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-print"></span> Cetak Bukti</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
          <div class="invoice">
            <div class="row">
              <div class="col-sm-6">
              <img src="{{asset('/logo/gunung.png')}}" style="margin-top:-40px; margin-left:-35px;" width="250" height="150" alt="">
                  <p>Address:	Landmark Pluit
                    Unit B1 Floor 8,9,10 <br>
                    Jl. Pluit Selatan Raya, <br>
                    Jakarta Utara, 14450 <br>
                    Phone:	021-8066-1888 <br>
                    E-Mail:	jntcallcenter@jet.co.id</p>
              </div>
            </div>

            <div class="row">

              <div class="col-sm-7">
              </div>

              <div class="col-sm-5 pull-right">
                <table class="w-full">
                  <tbody>
                    <tr>
                      <th>Tanggal Sekarang : </th>
                      <td>{{$tanggal_sekarang}}</td>
                    </tr>
                  </tbody>
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

                <table class="w-full">
                  <tbody>
                    <tr class="well" style="padding: 5px">

                    </tr>
                  </tbody>
                </table>


              </div>
            </div>
            <br>
            <div class="table-responsive">
              <table class="table invoice-table">
                <thead style="background: #F5F5F5;">
                  <tr>
                    <th>Nama</th>
                    <th>Nama Barang</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Hari Sewa</th>
                    <th>Tanggal Kembali</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($logs as $laporan)
                  <tr>
                    <td>{{$laporan->user->name}}</td>
                    <td>{{$laporan->barang->nama_barang}}</td>
                    @if($laporan->metode_pembayaran == 0)
                    <td style="color: red">belum membayar</td>
                    @elseif($laporan->metode_pembayaran == 1)
                    <td style="color: green">tunai</td>
                    @else
                    <td style="color: green">bank transfer</td>
                    @endif
                    @if($laporan->status_pembayaran == 0)
                    <td style="color: red">Belum Lunas</td>
                    @else($laporan->status_pembayaran)
                    <td style="color: green">Lunas</td>
                    @endif 
                    <td >{{$laporan->hari_sewa}}</td>
                    <td >{{$laporan->tanggal_kembali}}</td>
                  </tr>
                @endforeach
                  </tbody>
                </table>
              </div><!-- /table-responsive -->

              <table class="table invoice-total">
                <tbody>
                  <tr>
                  </tr>
                </tbody>
              </table>

              <hr>

              <div class="row">
                <div class="col-lg-8">
                  <div class="invbody-terms">
                    Terimakasih atas perhatiannya. Selamat berbelanja kembali! <br>
                    <p style="color: green">Note: Setelah melakukan pembayaran harap langsung mencetak bukti transaksi, bukti transaksi ditunjukan pada saat pengembalian barang.</p>
                  </div>
                  <br>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </body>
  <script>
    function printme(){
        window.print();
    }
  </script>
</html>
