@extends('layouts.backend.master')

@push('css')

@endpush

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <h3 class="page-title"> Data Transaksi </h3>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <div class="form-group">
            <label for="">Nama User</label>
            <input type="text" class="form-control" value="{{$transaksi->user->name}}" disabled>
        </div>
        <div class="form-group">
            <label for="">Nama Barang</label>
            <input type="text" class="form-control" value="{{$transaksi->barang->nama_alat}}" disabled>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-9">
                    <label for="">Status Barang</label>
                    @if($transaksi->status_barang == 0)
                    <input style="color: red;" type="text" class="form-control" value="Pending" disabled>
                    @else
                    <input style="color: green;" type="text" class="form-control" value="Pinjamkan" disabled>
                    @endif
                </div>
                <div class="col-md-2 mt-4">
                    @if($transaksi->status_barang == 0)  
                    <form action="{{route('statusOrder', $transaksi->id)}}" method="post">
                    {{csrf_field()}} 
                    {{method_field('PUT')}}
                    <input type="hidden" value="1" name="status_barang">  
                    <input type="submit" class="btn btn-success" value="Pinjamkan">
                    </form>
                    @else
                    <form action="{{route('statusOrder', $transaksi->id)}}" method="post">
                    {{csrf_field()}} 
                    {{method_field('PUT')}}
                    <input type="hidden" value="0" name="status_barang">  
                    <input type="submit" class="btn btn-info" value="Pending" >
                    </form>
                    @endif    
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Metode Pembayaran</label>
            @if($transaksi->metode_pembayaran == 0)
            <input type="text" class="form-control" value="Belum melakukan pembayaran" disabled>
            @elseif($transaksi->metode_pembayaran == 1)
            <input style="color:green" type="text" class="form-control" value="Dibayar melalui admin" disabled>
            @else
            <input style="color:green" type="text" class="form-control" value="Dibayar melalui transfer bank" disabled>
            @endif
        </div>
        <div class="form-group">
            <label for="">Status Pembayaran</label>
            @if($transaksi->status_pembayaran == 0)
            <input style="color: red" type="text" class="form-control" value="belum lunas" disabled>
            @else
            <input type="text" style="color: green" class="form-control" value="lunas" disabled>
            @endif
        </div>
        <div class="form-group">
            <label for="">Bukti Pembayaran</label>
            <input type="text" class="form-control" value="{{$transaksi->bukti_pembayaran}}" disabled>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-9">
                    <label for="">Konfirmasi</label>
                    @if($transaksi->konfirmasi == 0)
                    <input style="color: red;" type="text" class="form-control" value="Pembayaran belum dikonfirmasi admin" disabled>
                    @else
                    <input style="color: green;" type="text" class="form-control" value="pembayaran sudah dikonfirmasi admin" disabled>
                    @endif
                </div>
                <div class="col-md-2 mt-4">
                    @if($transaksi->konfirmasi == 0)  
                    <form action="{{route('konfirmasi', $transaksi->id)}}" method="post">
                    {{csrf_field()}} 
                    {{method_field('PUT')}}
                    <input type="hidden" value="1" name="konfirmasi">  
                    <input type="submit" class="btn btn-success" value="Konfirmasi">
                    </form>
                    @else
                    <form action="{{route('konfirmasi', $transaksi->id)}}" method="post">
                    {{csrf_field()}} 
                    {{method_field('PUT')}}
                    <input type="hidden" value="0" name="konfirmasi">  
                    <input type="submit" class="btn btn-info" value="Batal Konfirmasi" >
                    </form>
                    @endif    
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">QTY</label>
            <input type="text" class="form-control" value="{{$transaksi->qty}}" disabled>
        </div>
        <div class="form-group">
            <label for="">Tanggal Sewa</label>
            <input type="text" class="form-control" value="{{$transaksi->tanggal_sewa}}" disabled>
        </div>
        <div class="form-group">
            <label for="">Tanggal Kembali</label>
            @if($hari_telat == 0)
            <input type="text" class="form-control" value="{{$transaksi->tanggal_kembali}} ( Telat {{$hari_telat}} Hari)" style="color:green" disabled>
            @else
            <input type="text" class="form-control" value="{{$transaksi->tanggal_kembali}}" style="color:green" disabled>
            @endif
        </div>
        <!-- <div class="form-group">
            <label for="">Denda</label>
            @if($transaksi->denda == 0)
            <input type="text" style="color:green" class="form-control" value="{{$transaksi->denda}}" disabled>
            @else
            <input type="text" style="color:red" class="form-control" value="{{$transaksi->denda}}" disabled>
            @endif
        </div> -->
        </div>
    </div>
    </div>
</div>
</div>
@endsection



