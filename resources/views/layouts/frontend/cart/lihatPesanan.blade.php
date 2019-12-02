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
					<h1>Lihat Keranjang</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<!-- Start Sample Area -->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
            <p style="color:red">*Note : Jika barang tidak diambil sebelum tanggal pengambilan yang ditentukan, maka transaksi anda kami batalkan</p>
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Barang</th>
                                <th scope="col">Harga/Hari</th>
                                <th scope="col">Banyak Barang</th>
                                <th scope="col">Hari Sewa</th>
                                <th scope="col">Tanggal Pengambilan</th>
                                <th scope="col">Total</th>
								<th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        test
                        <tbody>    
                            @foreach($cartItems as $cartItem) 
                            <form action="{{route('updateCart',$cartItem->rowId)}}" method="POST">
                            @csrf
                            {{method_field('PUT')}}
                            <tr>
                                <td>{{$no++}}</td>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <!-- <img src="img/cart.jpg" alt=""> -->
                                        </div>
                                        <div class="media-body">
                                            <p>{{$cartItem->name}}</p>
                                            <input type="hidden" value="{{$cartItem->name}}">
                                            <input type="hidden" value="{{$cartItem->options->barang_id}}" name="barang_id">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>Rp {{number_format( $cartItem->price ,0, ',' , '.')}}</h5>
                                    <input type="hidden" name="harga" value="{{$cartItem->price}}">
                                </td>
                                <td>
                                    <div class="row">
                                        <select name="qty" class="col-md-8 offset-2 form-control" >
                                                <option value="{{$cartItem->qty}}" class="disable selected">{{$cartItem->qty}}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <select name="hari" class="col-md-8 offset-2 form-control" >
                                                <option value="{{$cartItem->options->hari}}" class="disable selected">{{$cartItem->options->hari}}</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input type="date" name="tanggal_sewa" value="{{$cartItem->options->tanggal_pengambilan}}" class="form-control">
                                </td>
                                <td>
                                    <h5>Rp.{{number_format( $cartItem->options->total,0, ',' , '.')}}</h5>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                        <form action="{{route('deleteItems',$cartItem->rowId)}}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="out_button_area">
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
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="{{route('beranda')}}">Lanjutkan Menyewa</a>
                                        <a class="primary-btn" href="{{route('checkout')}}">Proses Barang</a>
                                    </div>
                                </td>
                                <td>
                                    
                                </td>
                                <td></td>
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
