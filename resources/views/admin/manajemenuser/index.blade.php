@extends('layouts.backend.master')

@push('css')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <a href="{{route('manajemenuser.create')}}" class="btn btn-inverse-success btn-icon-text">
    <i class="icon-plus btn-icon-prepend"></i> Tambah Data </a>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Data User</h4>
        <table class="table" id="order-listing">
            <thead class="text-center">
            <tr>
                <th>No</th>
                <th>No. Identitas</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$user->no_identitas}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->telepon}}</td>
                <td>{{$user->alamat}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="{{route('manajemenuser.edit',$user->id)}}" class="btn btn-sm btn-outline-info btn-icon-text">
                    <i class="icon-pencil btn-icon-prepend"></i> Ubah </a>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-icon-text" onclick="hapusUser({{$user->id}})">
                    <i class="icon-trash btn-icon-prepend"></i> Hapus </button>
                    <form id="delete-form-{{$user->id}}" action="{{route('manajemenuser.destroy',$user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
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

@push('js')
<!-- sweet alert -->
<script type="text/javascript">
    function hapusUser(id){
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

    <!-- Plugin js for this page -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{asset('backend/js/data-table.js')}}"></script>
    <!-- End custom js for this page -->
@endpush
