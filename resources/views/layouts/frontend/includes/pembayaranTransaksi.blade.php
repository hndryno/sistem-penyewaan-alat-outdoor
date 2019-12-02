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
					<h1>Pembayaran</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<!-- Start Sample Area -->
	<section class="sample-text-area">
		<div class="container">
			<h3 class="text-heading">Petunjuk</h3>
			<p class="sample-text text-justify alert alert-info">
				Pilih kode transaksi yang akan anda bayarkan
			</p>

			<div class="cart_inner">
			<div class="table-responsive">
					<table class="table text-center">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Kode Transaksi</th>
							</tr>
						</thead>
						<tbody>
                        @forelse($transaksis as $transaksi)
							<tr>
								<td>
									<h5>{{$no++}}</h5>
								</td>
								<td>
									<h5><a href="{{route('transfer', $transaksi->kode_transaksi)}}">{{$transaksi->kode_transaksi}}</a></h5>	
								</td>
                            </tr>
						@empty
						<tr>
							<td>
								<h5></h5>
							</td>
							<td>
								<h5>Tidak ada data pembayaran</h5>	
							</td>
						</tr>
                        @endforelse
						</tbody>
					</table>
				</div>
            </div>
		</div>
    </section>
@endsection

@push('js')

@endpush

