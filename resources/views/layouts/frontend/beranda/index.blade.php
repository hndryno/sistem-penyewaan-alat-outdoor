@extends('layouts.frontend.master')

@section('name')

@push('css')

@endpush

@section('content')
<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="row single-slide align-items-center d-flex">
                    <div class="col-lg-5 col-md-6">
                    <div class="banner-content">
                        <h1>OutDoor <br>Campings!</h1>
                    <p>Kami menyewakan alat-alat camping untuk anda!</p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner-img">
                    <img class="img-fluid" src="{{asset('frontend/img/banner/tent.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>


<section class="features-area section_gap">
<div class="container">
    <div class="row features-inner">

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-features">
            <div class="f-icon">
                <img src="{{asset('frontend/img/features/f-icon1.png')}}" alt="">
            </div>
            <h6>Free Delivery</h6>
            <p>Free Shipping on all order</p>
        </div>
    </div>  

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-features">
            <div class="f-icon">
                <img src="{{asset('frontend/img/features/f-icon2.png')}}" alt="">
            </div>
                <h6>Return Policy</h6>
            <p>Free Shipping on all order</p>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-features">
            <div class="f-icon">
                <img src="{{asset('frontend/img/features/f-icon3.png')}}" alt="">
            </div>
                <h6>Return Policy</h6>
            <p>Free Shipping on all order</p>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-features">
            <div class="f-icon">
                <img src="{{asset('frontend/img/features/f-icon4.png')}}" alt="">
            </div>
                <h6>Return Policy</h6>
            <p>Free Shipping on all order</p>
        </div>
    </div>

    </div>
</div>
</section>

<section>

<div class="single-product-slider">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>PRODUK TERBARU</h1>
                    @if(Auth::user('name'))
                    <p style="color: green;">Halo {{ Auth::user()->name }}, Selamat datang di OUTDOOR INDONESIA. Berikut ini adalah produk-produk terbaru kami, silahkan berbelanja.</p>
                    @else
                   <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, accusamus veritatis. Enim, tempore quis corporis aperiam ratione, provident voluptatem velit hic sit est pariatur maxime cum laborum! Quis, dolores laudantium.</p> 
                    @endif
            </div>
        </div>
    </div>
<div class="row">
@foreach($barangs as $barang)
<div class="col-lg-3 col-md-6">
    <div class="single-product">
    <img style="height: 200px; width: 250px;" src="{{asset('/gambar/'.$barang->gambar)}}" alt="">
    <!-- <img class="img-fluid" src="{{asset('frontend/img/product/p1.jpg')}}" alt=""> -->
        <div class="product-details">
            <h6 class="text-center">{{$barang->nama_alat}}</h6>
            <div class="price text-center">
                <h6>Rp {{number_format( $barang->harga ,0, ',' , '.')}} / Hari</h6>
                @if($barang->stock > 0)
                <p style="color:green">{{$barang->stock}} (Stock Tersedia)</p>
                @elseif($barang)
                <p style="color:red">{{$barang->stock}} (Stock Habis)</p>
                @endif
            </div>
            <div class="prd-bottom">
                <a href="{{route('addToCart',$barang->id)}}" class="social-info">
                    <span class="ti-bag"></span>
                    <p class="hover-text">add to bag</p>
                </a>
                <a href="{{route('deskripsi',$barang->id)}}" class="social-info">
                    <span class="lnr lnr-move"></span>
                    <p class="hover-text">view more</p>
                </a>
                <p>Kategori: {{$barang->kategori->kategori}}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>


</section>

@endsection

@push('js')

@endpush
