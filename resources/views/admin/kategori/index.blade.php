@extends('layouts.backend.master')

@push('css')
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
@endpush

@section('content')
<!-- konten -->
<div class="content-wrapper">
<h2><ul><li> KATEGORI</li></ul></h2>
<div class="page-header">
    <button data-toggle="modal" data-target="#tambahKategoriModal" class="btn btn-inverse-success btn-icon-text">
    <i class="icon-plus btn-icon-prepend"></i> Tambah Data </button>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Data Kategori</h4>
        <div class="table-responsive">
        <table id="order-listing" class="table">
            <thead>
            <tr>
                <th><b>NO</b></th>
                <th><b>KATEGORI</b></th>
                <th><b>OPSI</b></th>
            </tr>
            </thead>
            <tbody>
            @foreach($kategoris as $kategori)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$kategori->kategori}}</td>
                <td>
                    <a href="{{route('kategori.edit',$kategori->id)}}" class="btn btn-sm btn-outline-info btn-icon-text">
                    <i class="icon-pencil btn-icon-prepend"></i> Ubah </a>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-icon-text" onclick="hapusKategori({{$kategori->id}})">
                    <i class="icon-trash btn-icon-prepend"></i> Hapus </button>
                    <form id="delete-form-{{$kategori->id}}" action="{{route('kategori.destroy',$kategori->id)}}" method="POST">
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
</div>
<!-- akhir konten -->

<!-- modal tambah -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog" aria-labelledby="tambahKategoriModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahKategoriModal">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('kategori.store')}}" method="POST">
        @csrf
        <div class="form-group {{ $errors->has('kategori') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="kategori" placeholder="Masukkan nama kategori" />
            @if ($errors->has('kategori'))
                <span class="help-block pull-right">
                    <p style="color: red">{{ $errors->first('kategori') }}</p>
                </span>
            @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- akhir modal tambah -->

@endsection

<!-- validasi modal -->
@if (count($errors) > 0)
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#tambahKategoriModal').modal('show');
        });
    </script>
@endif
<!-- akhir validasi modal -->

<!-- sweet alert -->
<script type="text/javascript">
    function hapusKategori(id){
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




