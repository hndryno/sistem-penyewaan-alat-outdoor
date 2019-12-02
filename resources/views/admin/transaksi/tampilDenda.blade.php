@extends('layouts.backend.master')

@push('css')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <h3 class="page-title"> Kode Transaksi : <span class="bg bg-success" style="color: white">{{$kode_transaksi}}</span></h3>

    <a href="{{route('cetakpdf')}}" class="btn btn-success"><i class="icon-printer btn-icon-prepend"> Cetak</i></a> 
</div>
    <p>Transaksi ini diselesaikan pada : {{$tanggal_sekarang->format('Y-m-d')}}</p>   
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Pembayaran</th>
                <th>Tanggal Pengambilan</th>
                <th>Tanggal kembali</th>
                <th>Status Pengembalian</th>
                <th>Denda</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $denda_hasil = 0;
                $denda = 0; 
            ?>
            @foreach($transaksis as $transaksi)
            <tr class="text-center">
                <td>{{$no++}}</td>
                <td>{{$transaksi->barang->nama_alat}}</td>
                @if($transaksi->metode_pembayaran == 0)
                <td style="color: red">belum membayar</td>
                @elseif($transaksi->metode_pembayaran == 1)
                <td style="color: green">tunai</td>
                @else
                <td style="color: green">bank transfer</td>
                @endif
                <td>{{$transaksi->tanggal_sewa->format('Y-m-d')}}</td>
                <td>{{$transaksi->tanggal_kembali->format('Y-m-d')}}</td>
                @if($transaksi->pengembalian_barang == 0)
                <td>
                        <button type="submit" class="btn btn-danger btn-xs" onclick="kembalikanBarang({{$transaksi->id}})">Barang Belum Dikembalikan</button>
                    <form id="pengembalian-form-{{$transaksi->id}}" action="{{route('pengembalian', $transaksi->id)}}" method="post">
                        {{csrf_field()}} 
                        {{method_field('PUT')}}
                        <input type="hidden" value="1" name="pengembalian_barang">  
                    </form></td>
                @else
                <td>
                    <p style="color: green">Barang sudah dikembalikan</p>
                </td>
                @endif
                @if($tanggal_sekarang > $transaksi->tanggal_kembali)
                <td>Rp. {{ $denda = $transaksi->tanggal_kembali->diffInDays($tanggal_sekarang, true) * 10000 }}</td>
                @else
                <td>0</td>
                @endif
            </tr>
                <?php $denda_hasil += $denda ?>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p>Rp. {{$denda_hasil}}</p>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
        <div class="mb-5 mr-3 text-right">
        @if($jumlah_pengembalian == $jumlah_transaksi)
            <form action="{{route('transaksiSelesai')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$kode_transaksi}}" name="kode_transaksi">
                <button class="btn btn-success">Selesaikan Transaksi</button>
            </form>
        @else
        <p style="color:red">* Kembalikan semua barang terlebih dahulu</p>
        @endif
        </div>
    </div>
    </div>
</div>
</div>
@endsection

<!-- sweet alert -->
<script type="text/javascript">
    function kembalikanBarang(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                cancelButton: 'btn btn-danger',
                confirmButton: 'btn btn-success'
            },
            buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('pengembalian-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Dibatalkan',
                'Data anda batal dihapuskan',
                'error'
                )
            }
        })
    }

</script>
<!-- akhir sweet alert -->


@push('js')
    <!-- Plugin js for this page -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{asset('backend/js/data-table.js')}}"></script>
    <!-- End custom js for this page -->
@endpush


