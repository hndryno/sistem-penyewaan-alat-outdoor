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
					<h1>Transfer Bank</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<!-- Start Sample Area -->
	<section class="sample-text-area">
		<div class="container">
			<h3 class="text-heading">Petunjuk</h3>
			<div class="alert alert-success">
				<p class="sample-text text-justify">
					Setelah melakukan pemesanan untuk menyewa barang, tolong lakukan pembayaran ke rek BCA dengan nomor 873874384 A/N : PT.OutDoor Indonesia. Setelah melakukan pembayaran, bukti foto dikirimkan melalui form ini. Jika tidak mengirimkan Foto, Transaksi tidak akan di Proses. Setelah mengirimkan bukti transfer berupa foto transaksi anda akan langsung di proses oleh admin. 
					<hr>
					Transaksi anda akan segera diproses setelah anda mengupload bukti transaksi
				</p>
			</div>

			<div class="cart_inner">
			<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Nama Barang</th>
								<th scope="col">Jumlah</th>
                                <th scope="col">Hari Sewa</th>
								<th scope="col">Harga Barang</th>
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
                                </td>
								<td>
									Subtotal :
								</td>
								<td>
									Rp {{number_format( $subtotal ,0, ',' , '.')}}
								</td>
                            </tr>
						</tbody>
					</table>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" value="{{$user->name}}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" value="{{$user->alamat}}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" value="{{$user->email}}" readonly class="form-control">
                    </div>
					<form action="{{ route('bankTransferPut') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Masukan Bukti Transfer Berupa Foto</label>
                            <input type="file" name="bukti_pembayaran">
                        </div>
                            <button class="btn btn-success">Kirim Bukti Foto</button>
                    </form>
				</div>
            </div>
		</div>
    </section>
@endsection

@push('js')

@endpush

