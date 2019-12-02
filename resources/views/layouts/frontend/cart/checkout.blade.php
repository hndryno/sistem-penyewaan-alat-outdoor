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
    <section class="order_details section_gap">
		<div class="container">
			<div class="label-success">
				<h3 class="title_confirmation">Silahkan tekan tombol chekout untuk memproses barang.</h3>
			</div>
			
			<div class="order_details_table">
			
				<h2>Detail Pemesanan</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Nama Alat</th>
								<th scope="col">Jumlah</th>
                                <th scope="col">Hari Sewa</th>
								<th scope="col">Tanggal Pengambilan</th>
								<th scope="col">Tanggal Kembali</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($cartItems as $cartItem)
							<tr>
								<td>
									<h5>{{$cartItem->name}}</h5>
								</td>
								<td>
									<h5>{{$cartItem->qty}}</h5>
								</td>
                                <td>
                                    <h5>{{$cartItem->options->hari}}</h5>
                                </td>
								<td>
									<h5>{{$cartItem->options->tanggal_pengambilan}}</h5>	
								</td>
								<td>
									<h5>{{$cartItem->options->batas_pengembalian}}</h5>
								</td>
								<td>
									<h5>Rp {{number_format( $cartItem->options->total,0, ',' , '.')}}</h5>
								</td>
                            </tr>
                        @endforeach
							<tr>
								<td>
								</td>
								<td>
								</td>
                                <td>
                                </td>
								<td>
								</td>
								<td>
									<h4>SubTotal : Rp {{Cart::subtotal()}} </h4> 
								</td>
								<td>
									
								</td>
                            </tr>
							<tr>
								<td>
								</td>
								<td>
								</td>
                                <td>
                                </td>
								<td>
								</td>
								<td>
								</td>
								<td>
									<form action="{{route('pembayaran')}}" method="POST">
									@csrf
										<button class="btn btn-success">Chekout</button>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<p style="color:red">*Note : Jika barang tidak diambil sebelum tanggal pengambilan yang ditentukan, maka transaksi anda kami batalkan</p>
			</div>
		</div>
	</section>
<!-- endsection -->

@endsection

@push('js')

@endpush
