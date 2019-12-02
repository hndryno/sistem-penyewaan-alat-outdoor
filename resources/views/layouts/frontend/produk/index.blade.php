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
					<h1>Produk</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Kategori</div>
					<ul class="main-categories">
						@foreach($kategoris as $kategori)
						<li class="main-nav-list"><a href="{{route('filter',$kategori->id)}}">{{$kategori->kategori}}</a>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						@foreach($barangs as $barang)
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
							    <img style="height: 200px; width: 250px;" src="{{asset('/gambar/'.$barang->gambar)}}" alt="">
								<!-- <img class="img-fluid" src="{{asset('frontend/img/product/p1.jpg')}}" alt=""> -->
								<div class="product-details">
									<h6 class="">{{$barang->nama_alat}}</h6>
									<div class="price">
										<h6>Rp {{number_format( $barang->harga ,0, ',' , '.')}} / Hari</h6>
										@if($barang->stock > 0)
										<p style="color:green">{{$barang->stock}} (Stock Tersedia)</p>
										@else
										<p style="color:red">{{$barang->stock}} (Stock Habis)</p>
										@endif
									</div>
									<div class="prd-bottom">

										<a href="{{route('addToCart',$barang->id)}}" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="{{route('deskripsi', $barang->id)}}" class="social-info">
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
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<!-- <div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
					</div>
					<div class="pagination">
						<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<a href="#" class="active">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
						<a href="#">6</a>
						<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				End Filter Bar -->
			</div>
		</div>
    </div>

    <div class="py-4">
    </div>
@endsection

@push('js')

@endpush
