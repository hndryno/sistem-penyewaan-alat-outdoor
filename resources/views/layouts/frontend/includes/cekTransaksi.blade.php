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
				Pembayaran dilakukan setelah anda melakukan pemesanan, dibawah ini adalah tagihan dari barang yang anda sewa. Silahkan memilih jenis pembayaran yang anda akan lakukan. Untuk pembayaran langsung silahkan mengklik tombol pembayaran langsung, untuk pembayaran melalui bank mengklik tombol pembayaran bank.
			</p>
			<a href="{{route('cetak_pdf_user')}}" class="btn btn-success fa fa-print float-right"> Cetak</a>

			<div class="cart_inner">
			<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Nama Barang</th>
								<th scope="col">Jumlah</th>
                                <th scope="col">Hari Sewa</th>
								<th scope="col">Harga Barang</th>
                                <th scope="col">Status transaksi</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($transaksis as $transaksi)
							<tr>
								<td>
									<h5>{{$transaksi->barang->nama_alat}}</h5>
								</td>
								<td>
									<h5>{{$transaksi->qty}}</h5>
								</td>
								<td>
									<h5>{{$transaksi->hari_sewa}}</h5>
								</td>
                                <td>
                                    <h5>{{$transaksi->harga_barang}}</h5>
                                </td>
                                <td>
                                    @if($transaksi->status_pembayaran == 0)
									<h5 style="color: red">Transaksi belum diproses</h5>
                                    @else
                                    <h5 style="color: green">Transaksi Sudah diproses</h5>	
                                    @endif
								</td>
								<td>
									<h5>{{$transaksi->total}}</h5>	
								</td>
                            </tr>
                        @endforeach
							<tr>
								<td>
								</td>
								<td>
								</td>
                                <td>
                                <td></td>
                                </td>
								<td>
								Subtotal : 
								</td>
								
								<td>
								    <p class="alert alert-success">Rp {{number_format( $subtotal ,0, ',' , '.')}}</p>
								</td>
                            </tr>
						</tbody>
					</table>
				</div>
            </div>
		</div>
    </section>
@endsection

@push('js')

@endpush

