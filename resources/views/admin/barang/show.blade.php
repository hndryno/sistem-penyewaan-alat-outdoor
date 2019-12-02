@extends('layouts.backend.master')

@section('content')
<div class="content-wrapper">
<h2><ul><li>BARANG</li></ul></h2>
<div class="page-header">
    <h3>Data {{$barang->nama_alat}}</h3>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        @csrf
        {{method_field('PUT')}}
            <div class="form-group">
                <div class="col-md-6"> 
                    <div class="row">
                        <div class="col-md-12">
                        <label class="">Gambar : </label>
                        <br>
                        <img style="height: 150px; width: 230px;" src="{{asset('/gambar/'.$barang->gambar)}}">
                        </div>
                    </div>
                    <br>   
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label class="">Kategori : </label>
                        <input type="text" class="form-control" name="nama_alat" value="{{$barang->kategori->kategori}}" disabled/>
                    </div>
                    <div class="col-md-6">
                        <label class="">Nama Alat : </label>
                        <input type="text" class="form-control" name="nama_alat" value="{{$barang->nama_alat}}" disabled/>
                        <span class="help-block pull-right">
                        </span>
                    </div>
                </div>
            </div>
           

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label class="">Harga : </label>
                        <input type="text" class="form-control" name="harga" value="Rp {{number_format( $barang->harga ,0, ',' , '.')}}" disabled/>
                    </div>
                    <div class="col-md-6">
                        <label class="">Stock : </label>
                        @if($barang->stock > 0 )
                        <input type="text" class="form-control" name="stock" style="color:green" value="{{$barang->stock}} (Stock tersedia)" readonly/>
                        @elseif($barang->stock == 0)
                        <input type="text" class="form-control" name="stock" style="color:red" value="{{$barang->stock}} (Stock habis)" readonly/>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label class="">Keterangan : </label>
                        <textarea class="form-control" id="exampleTextarea1" name="keterangan" rows="5" disabled>{{$barang->keterangan}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</div>
@endsection

@push('js')
    <script src="{{asset('backend/js/file-upload.js')}}"></script>
@endpush
