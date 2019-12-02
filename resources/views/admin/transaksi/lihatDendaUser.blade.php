@extends('layouts.backend.master')

@push('css')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <h3 class="page-title">Transaksi Selesai</h3>
    <a href="{{route('cetakpdf')}}" class="btn btn-success"><i class="icon-printer btn-icon-prepend"> Print</i></a> 
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <table class="table table-responsive" id="order-listing">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Nama Barang</th>
                <th>Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Tanggal kembali</th>
                <th>Denda</th>
                <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $transaksi)
            <tr class="text-center">
                <td>{{$no++}}</td>
                <td>{{$transaksi->user}}</td>
                <td>{{$transaksi->nama_barang}}</td>
                @if($transaksi->metode_pembayaran == 0)
                <td style="color: red">belum membayar</td>
                @elseif($transaksi->metode_pembayaran == 1)
                <td style="color: green">tunai</td>
                @else
                <td style="color: green">bank transfer</td>
                @endif
                @if($transaksi->status_pembayaran == 0)
                <td style="color: red">Belum Lunas</td>
                @else($transaksi->status_pembayaran)
                <td style="color: green">Lunas</td>
                @endif 
                @if($tanggal_sekarang > $transaksi->tanggal_kembali)
                <td style="color: red">{{$transaksi->tanggal_kembali}}</td>
                @else
                <td style="color: green">{{$transaksi->tanggal_kembali}}</td>
                @endif
                <td style="color: green">{{$transaksi->denda}}</td>
                <td>
                    <div class="form-group">
                        <form id="delete-form-{{$transaksi->id}}" action="{{route('deleteLog',$transaksi->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn mt-3 btn-sm btn-group btn-outline-danger btn-icon-text" onclick="hapusTransaksi({{$transaksi->id}})">
                            <i class="icon-trash btn-icon-prepend"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>
</div>
@endsection

<!-- sweet alert -->
<script type="text/javascript">
    function hapusTransaksi(id){
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
                document.getElementById('delete-form-'+id).submit();
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


