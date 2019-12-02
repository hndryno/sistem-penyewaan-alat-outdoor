@extends('layouts.frontend.master')

@section('name')

@push('css')

@endpush

@section('content')
    <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Detail Produk</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->


	<!--================Single Product Area =================-->
	<div class="product_image_area mb-5">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<img style="height: 500px; width: 500px;" src="{{asset('/gambar/'.$barang->gambar)}}" alt="">
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{$barang->nama_alat}}</h3>
						<h2>Rp {{number_format( $barang->harga ,0, ',' , '.')}}</h2>
						<ul class="list">
							<li><span>Kategori</span> : {{$barang->kategori->kategori}}</li>
							@if($barang->stock > 0 )
							<li style="color: green;"><span>Stock</span> : {{$barang->stock}}</li>
							@else
							<li style="color: red;"><span>Stock</span> : {{$barang->stock}}</li>
							@endif
						</ul>
						<p class="text-justify">{{$barang->keterangan}}</p>
						<div class="prd-bottom">
							<a class="btn btn-primary" href="{{route('addToCart',$barang->id)}}">
								<i class="ti ti-bag"> add to bag</i>
							</a>
							<a class="btn btn-danger" href="{{route('beranda')}}">
								Beranda
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!-- Start related-product Area -->

@endsection

@push('js')

@endpush
