@extends('layouts.backend.master')

@section('content')
<div class="content-wrapper">
<h2><ul><li>BARANG</li></ul></h2>
<div class="page-header">
    <h3> Tambah Data Barang </h3>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <form class="forms-sample" method="POST" action="{{route('barang.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('kategori_id') ? ' has-error' : '' }}">
                        <label class="">Kategori : </label>
                        <select class="form-control" name="kategori_id" id="">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{$kategori->id}}">{{$kategori->kategori}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('kategori_id'))
                        <span class="help-block pull-right">
                            <p style="color: red">{{ $errors->first('kategori_id') }}</p>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 {{ $errors->has('nama_alat') ? ' has-error' : '' }}">
                        <label class="">Nama Alat : </label>
                        <input type="text" class="form-control" name="nama_alat" placeholder="Masukkan Alat ..." />
                        @if ($errors->has('nama_alat'))
                        <span class="help-block pull-right">
                            <p style="color: red">{{ $errors->first('nama_alat') }}</p>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('gambar') ? ' has-error' : '' }}">
                        <label class="">File upload</label>
                        <br>
                        <input type="file" name="gambar">
                        @if ($errors->has('gambar'))
                        <span class="help-block pull-right">
                            <p style="color: red">{{ $errors->first('gambar') }}</p>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 {{ $errors->has('stock') ? ' has-error' : '' }}">
                        <label class="">Stock : </label>
                        <input type="text" class="form-control" name="stock" placeholder="Masukkan Barang ..." />
                        @if ($errors->has('stock'))
                        <span class="help-block pull-right">
                            <p style="color: red">{{ $errors->first('stock') }}</p>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('harga') ? ' has-error' : '' }}">
                        <label class="">Harga : </label>
                        <input type="text" class="form-control" name="harga" placeholder="Masukkan Barang ..." />
                        @if ($errors->has('harga'))
                        <span class="help-block pull-right">
                            <p style="color: red">{{ $errors->first('harga') }}</p>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 {{ $errors->has('keterangan') ? ' has-error' : '' }}">
                        <label class="">Keterangan : </label>
                        <textarea class="form-control" id="exampleTextarea1" name="keterangan" placeholder="Masukkan keterangan..." rows="5"></textarea>
                        @if ($errors->has('keterangan'))
                        <span class="help-block pull-right">
                            <p style="color: red">{{ $errors->first('keterangan') }}</p>
                        </span>
                        @endif
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-sm btn-primary mr-2">Simpan</button>
            <a href="{{route('kategori.index')}}" class="btn btn-sm btn-light">Batal</a>
        </form>
        </div>
    </div>
    </div>

</div>
@endsection

@push('js')
    <script src="{{asset('backend/js/file-upload.js')}}"></script>
@endpush
