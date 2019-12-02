@extends('layouts.backend.master')

@push('css')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
<div class="content-wrapper">
<h2><ul><li>BARANG</li></ul></h2>
<div class="page-header">
    <a href="{{route('barang.create')}}" class="btn btn-inverse-success btn-icon-text">
    <i class="icon-plus btn-icon-prepend"></i> Tambah Data </a>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Data Barang</h4>
        <table class="table text-center" id="order-listing">
            <thead>
            <tr>
                <th><b>No</b></th>
                <th><b>Kategori</b></th>
                <th><b>Nama Barang</b></th>
                <th><b>Gambar</b></th>
                <th><b>Stok</b></th>
                <th><b>Harga</b></th>
                <th><b>Opsi</b></th>
            </tr>
            </thead>
            <tbody>
            @foreach($barangs as $barang)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$barang->kategori->kategori}}</td>
                <td>{{$barang->nama_alat}}</td>
                <td><img style="height: 50px; width: 100px;" src="{{asset('/gambar/'.$barang->gambar)}}"></td>
                @if($barang->stock > 0 )
                <td style="color:green">{{$barang->stock}} (Stock tersedia)</td>
                @elseif($barang->stock == 0 )
                <td style="color:red">{{$barang->stock}} (Stock habis)</td>
                @endif
                <td>Rp {{number_format( $barang->harga ,0, ',' , '.')}}</td>
                <td>
                    <a href="{{route('barang.edit',$barang->id)}}" class="btn btn-sm btn-outline-info btn-icon-text">
                    <i class="icon-pencil btn-icon-prepend"></i> Ubah </a>
                    <a href="{{route('barang.show',$barang->id)}}" class="btn btn-sm btn-outline-warning btn-icon-text">
                    <i class="icon-eye btn-icon-prepend"></i> Lihat </a>
                     <button type="button" class="btn btn-sm btn-outline-danger btn-icon-text" onclick="hapusBarang({{$barang->id}})">
                    <i class="icon-trash btn-icon-prepend"></i> Hapus </button>
                    <form id="delete-form-{{$barang->id}}" action="{{route('barang.destroy',$barang->id)}}" method="POST">
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

<!-- sweet alert -->
<script type="text/javascript">
    function hapusBarang(id){
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
