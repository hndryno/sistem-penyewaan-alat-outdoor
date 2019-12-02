@extends('layouts.backend.master')

@push('css')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <h3 class="page-title">Semua Transaksi</h3>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <center>
        <table class="table text-center" id="order-listing">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$user->name}}</td>
                <td>
                    <div class="form-group mt-3">
                            <a  href="{{route('userTransaksi.show',$user->id)}}" class="btn btn-sm btn-group btn-outline-warning btn-icon-text">
                            Lihat data transaksi</a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </center>
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

    function selesaiTransaksi(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                cancelButton: 'btn btn-danger',
                confirmButton: 'btn btn-success'
            },
            buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
            title: 'Apakah anda yakin?',
            text: "Transaksi akan diselesaikan",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('selesai-form-'+id).submit();
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


