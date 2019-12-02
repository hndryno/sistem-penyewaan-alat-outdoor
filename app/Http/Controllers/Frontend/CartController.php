<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Barang;
use Cart;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['addToCart']);
    }

    public function addToCart(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        if($barang->stock === 0){
            toastr()->error('Barang kosong!');
            return back();
        }
        $barang->stock = $barang->stock - 1;
        $barang->save();
        $tanggal_sekarang = '';
        $batas_pengembalian = Carbon::now()->addDays()->endOfDay()->format('Y-m-d');
        Cart::add($id, $barang->nama_alat, 1, $barang->harga, 1,['barang_id' => $barang->id, 'hari' => 1, 'tanggal_pengambilan' => $tanggal_sekarang, 'batas_pengembalian' => $batas_pengembalian, 'total' => $barang->harga * 1 * 1] );
        toastr()->success('Barang berhasil dimasukan ke keranjang');
        return back();
    }

    public function updateCart(Request $request, $id)
    {    
        $barang_id = $request->barang_id;
        $barang = Barang::where('id',$barang_id)->first();
        $stock = ($barang->stock + 1);
        $jumlah_pesan_barang = $request->qty;
        if($jumlah_pesan_barang > $stock){
            toastr()->error('Maaf jumlah barang yang anda pesan melebihi stock yang tersedia!');
            return back();
        }else{
            $barang->stock = $stock - $request->qty;
            $barang->save();
            $tanggal_kembali = $request->hari;
            $tanggal_sewa = Carbon::parse($request->tanggal_sewa);
            $total = $request->hari * $request->qty * $request->harga;
            $batas_pengembalian = $tanggal_sewa->addDays($tanggal_kembali)->endOfDay()->format('Y-m-d');
            // return $batas_pengembalian;
            $tanggal_sewa2 = Carbon::parse($request->tanggal_sewa)->format('Y-m-d');
            Cart::update($id,['qty' => $request->qty, 'weight'=>$request->hari, 'options' => ['barang_id' => $request->barang_id, 'hari' => $request->hari, 'tanggal_pengambilan' => $tanggal_sewa2, 'batas_pengembalian' => $batas_pengembalian, 'total' => $total ]]);
            toastr()->success('Barang berhasil di update!');
            return back();
        }
    }

    public function deleteItems(Request $request, $id)
    {
        $barang_id = $request->id;
        $barang = Barang::findOrFail($barang_id);
        $barang->stock = $barang->stock + $request->stock;
        $barang->save();
        Cart::remove($id);
        toastr()->success('Data berhasil dihapus dari keranjang');
        return back();
    }

    public function lihatPesanan()
    {
        $no = 1;
        $user = Auth::user(); 
        $cartItems = Cart::content();
        return view('layouts.frontend.cart.lihatPesanan',compact('cartItems','no'));
    }
}
