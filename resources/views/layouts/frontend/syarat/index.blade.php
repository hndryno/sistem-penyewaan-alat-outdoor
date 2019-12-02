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
					<h1>Syarat & Ketentuan</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<!-- Start Sample Area -->
	<section class="sample-text-area alert alert-success">
		<div class="container alert alert-success">
			<h3 class="text-heading">Syarat & Ketentuan</h3>
			<b>Baca dan cermati dengan bijak</b>
			<hr>
			<ul>
				<li>1. Penyewa diwajibkan menyimpan SIM/ KTP/ KTM atau tanda pengenal lainnya yang masih berlaku sebagai jaminan.</li>
				<li>2. Penyewa diwajibkan menyimpan nomor HP yang bisa dihubungi.</li>
				<li>3. Penyewa diwajibkan mengisi alamat dengan alamat lengkap yang berlaku.</li>
				<li>4. Apabila terjadi kerusakan atau kehilangan barang, maka biaya kerusakan ditanggung oleh penyewa.</li>
				<li>5. Denda berlaku apabila telat mengembalikan barang.</li>
			</ul>
		</div>
    </section>
@endsection

@push('js')

@endpush
