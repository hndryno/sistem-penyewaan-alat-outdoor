@extends('layouts.backend.master')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    <div class="d-sm-flex align-items-baseline report-summary-header">
                        <h5 class="font-weight-semibold">Dashboard</h5> <span class="ml-auto"><a href="{{route('admin.dashboard')}}">Refresh Halaman</a></span> <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                    </div>
                    </div>
                </div>
                <div class="row report-inner-cards-wrapper">
                    <div class=" col-md -6 col-xl report-inner-card">
                    <div class="inner-card-text">
                        <span class="report-title">KATEGORI</span>
                        @if($jumlah_kategori == 0)
                        Kosong
                        @else
                        <h4>{{$jumlah_kategori}}</h4>
                        @endif
                        <span class="report-count"><a href="{{route('kategori.index')}}">lihat selengkapnya</a></span>
                    </div>
                    <div class="inner-card-icon bg-success">
                        <i class="icon-rocket"></i>
                    </div>
                    </div>
                    <div class="col-md-6 col-xl report-inner-card">
                    <div class="inner-card-text">
                        <span class="report-title">JENIS BARANG</span>
                        @if($jumlah_barang == 0)
                        Kosong
                        @else
                        <h4>{{$jumlah_barang}}</h4>
                        @endif
                        <span class="report-count"><a href="{{route('barang.index')}}">lihat selengkapnya</a></span>
                    </div>
                    <div class="inner-card-icon bg-danger">
                        <i class="icon-briefcase"></i>
                    </div>
                    </div>
                    <div class="col-md-6 col-xl report-inner-card">
                    <div class="inner-card-text">
                        <span class="report-title">PENDING</span>
                        @if($jumlah_pending == 0)
                        Kosong
                        @else
                        <h4>{{$jumlah_pending}}</h4>
                        @endif
                        <span class="report-count"><a href="">lihat selengkapnya</a></span>
                    </div>
                    <div class="inner-card-icon bg-warning">
                        <i class="icon-globe-alt"></i>
                    </div>
                    </div>
                    <div class="col-md-6 col-xl report-inner-card">
                    <div class="inner-card-text">
                        <span class="report-title">DIPINJAMKAN</span>
                        @if($jumlah_dipinjamkan == 0)
                        Kosong
                        @else
                        <h4>{{$jumlah_dipinjamkan}}</h4>
                        @endif
                        <span class="report-count"><a href="">lihat selengkapnya</a></span>
                    </div>
                    <div class="inner-card-icon bg-primary">
                        <i class="icon-diamond"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
