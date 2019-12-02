<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Barang;
use App\Kategori;
use App\User;
use App\Transaksi;
use Cart;
use Auth;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['checkout','pembayaran','transfer', 'tunai', 'bankTransfer']);
    }

    public function master()
    {
        return view('layouts.frontend.master');
    }

    public function beranda()
    {
        $no = 1;
        $cartItems = Cart::content();
        $barangs = Barang::latest()->take(8)->get();
        $user = Auth::user();
        return view('layouts.frontend.beranda.index',compact('barangs','cartItems','no','user'));
    }

    public function produk()
    {
        $no = 1;
        $cartItems = Cart::content();
        $barangs = Barang::all();
        $kategoris = Kategori::all();
        return view('layouts.frontend.produk.index', compact('kategoris','barangs','cartItems','no'));
    }

    public function hubungi()
    {
        $no = 1;
        $cartItems = Cart::content();
        return view('layouts.frontend.hubungi.index',compact('cartItems','no'));
    }

    public function syarat()
    {
        $no = 1;
        $cartItems = Cart::content();
        return view('layouts.frontend.syarat.index', compact('cartItems','no'));
    }

    public function daftar()
    {
        $no = 1;
        $cartItems = Cart::content();
        return view('layouts.frontend.daftar.index', compact('cartItems','no'));
    }

    public function daftarBaru(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'no_identitas' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'jenis_identitas' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = new User;
        $user->jenis_identitas = $request->jenis_identitas;
        $user->no_identitas = $request->no_identitas;
        $user->name = $request->name;
        $user->telepon = $request->telepon;
        $user->alamat = $request->alamat;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            toastr()->success('User baru berhasil di daftarkan! Silahkan Login!');
        }else{
            toastr()->error('Gagal daftar!');
        }
        return redirect()->route('daftar');

    }

    public function checkout()
    {
        $cartItems = Cart::content();
        // $subtotal = (int)Cart::subtotal();
        return view('layouts.frontend.cart.checkout',compact('cartItems'));
    }

    public function pembayaran(Request $request)
    {
        $pembayaran = new Transaksi;
        $isi_cart = Cart::content();
        // return $isi_cart;
        if($isi_cart->count() == 0){
            toastr()->warning('Maaf anda tidak bisa memproses transaksi dalam keadaan kosong!');
            return back();
        }
        $kode_transaksi = str_random(32);
        foreach(Cart::content() as $cart)
        {
            $pembayaran = Auth::user()->transaksi()->create([
                'barang_id' => $cart->options->has('barang_id') ? $cart->options->barang_id : '',
                'kode_transaksi' => $kode_transaksi,
                'qty' => $cart->qty,
                'status_barang' => 0,
                'status_penyewaan' => 0,
                'harga_barang' => $cart->price,
                'konfirmasi' => 0,
                'total' => $cart->options->hari * $cart->price * $cart->qty,
                'bukti_pembayaran' => 'kosong',
                'hari_sewa' => $cart->options->hari,
                'tanggal_sewa' => $cart->options->tanggal_pengambilan,
                'tanggal_kembali' => $cart->options->batas_pengembalian,
                ]);
            }
        $pembayaran->save();
        Cart::destroy();
        toastr()->success('Barang berhasil diproses, harap segera melakukan pembayaran!');

        return redirect()->route('transfer');
    }

    public function deskripsi($id){
        $barang = Barang::findOrFail($id);
        $cartItems = Cart::content();
        return view('layouts.frontend.produk.show', compact('barang', 'cartItems'));

    }

    public function transfer($kode_transaksi)
    {
        $cartItems = Cart::content();
        // $user_id = Auth::user()->id;
        $kode_transaksi = $kode_transaksi;
        $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi);
        $transaksis = $transaksi->where('metode_pembayaran', 0)->get();
        $jumlah = $transaksi->where('metode_pembayaran', 0)->get('total');
        $subtotal = $jumlah->sum('total');
        return view('layouts.frontend.includes.pembayaran', compact('cartItems','transaksis','subtotal','kode_transaksi'));
    }

    public function kodeTransaksi(){
        $user_id = Auth::user()->id;
        $cartItems = Cart::content();
        $no = 1;
        $transaksi = Transaksi::where('user_id', $user_id);
        $transaksis = $transaksi->where('metode_pembayaran', 0)->get()->unique('kode_transaksi');
        return view('layouts.frontend.includes.pembayaranTransaksi', compact('cartItems','no','transaksis'));
    }

    public function cekKodeTransaksi(){
        $user_id = Auth::user()->id;
        $cartItems = Cart::content();
        $no = 1;
        $transaksi = Transaksi::where('user_id', $user_id);
        $transaksis = $transaksi->where('metode_pembayaran', '!=', 0)->get()->unique('kode_transaksi');
        return view('layouts.frontend.includes.cekKodeTransaksi', compact('cartItems','no','transaksis'));
    }

    public function tunai($kode_transaksi){
        $auth_id = Auth::user()->id;
        $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi);
        $data_transaksi = $transaksi->where('status_pembayaran', 0)->update(['metode_pembayaran' => '1', 'bukti_pembayaran' => 'dibayar tunai ke admin']);
        toastr()->success('terimakasih telah melakukan pembayaran, harap menunggu konfirmasi dari admin, konfirmasi dari admin akan muncul dimenu pesanan'); 
        return back();
    }

    public function bankTransferGet(){
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $cartItems = Cart::content();
        $transaksi = Transaksi::where('user_id', $user_id);
        $transaksis = $transaksi->where('metode_pembayaran', 0)->get();
        $jumlah = $transaksi->where('metode_pembayaran', 0)->get('total');
        $subtotal = $jumlah->sum('total');
        return view('layouts.frontend.includes.bankTransfer', compact('user_id','transaksis','cartItems', 'user','subtotal'));
    }

    public function bankTransferPut(Request $request){
        $auth_id = Auth::user()->id;
        $transaksi = Transaksi::where('user_id', $auth_id)->get();
        $data_transaksi = $transaksi->where('metode_pembayaran', 0);
        foreach($data_transaksi as $data){
            $data->metode_pembayaran = 2;
            $files= $request->file('bukti_pembayaran');
            if($request->hasFile('bukti_pembayaran')){
                foreach($files as $file){
                    $data->metode_pembayaran = 2;
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $location = public_path('/gambar');
                    $request->file('bukti_pembayaran')->move($location, $filename);
                    $data_transaksi->bukti_pembayaran = $filename;
                }
            } 
            $data->save();
        }
             
        toastr()->success('terimakasih telah melakukan pembayaran, harap menunggu konfirmasi dari admin, konfirmasi dari admin akan muncul dimenu pesanan');   
        return back();
    }

    public function cekTransaksi($kode_transaksi){
        $cartItems = Cart::content();
        $user_id = Auth::user()->id;
        $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi);
        $transaksis = $transaksi->where('metode_pembayaran', '!=', 0)->get();
        $subtotal = $transaksis->sum('total');
        return view('layouts.frontend.includes.cekTransaksi', compact('cartItems','transaksis','subtotal'));
    }

    public function cetak_pdf_user(){
        $user_id = Auth::user()->id;
        $transaksi = Transaksi::where('user_id', $user_id);
        $logs = $transaksi->where('metode_pembayaran', '!=', 0)->get();
        $tanggal_sekarang =  Carbon::now()->format('Y-m-d');
        $user = Auth::user()->name;
        return view('layouts.frontend.includes.print',compact('logs','tanggal_sekarang','user'));
    }

    public function filter($id){
        $barangs = Barang::where('kategori_id', $id)->get();
        $cartItems = Cart::content();
        $kategoris = Kategori::all();
        return view('layouts.frontend.produk.index', compact('barangs','cartItems','kategoris'));
    }

    public function profile(){
        $user = Auth::user();
        $cartItems = Cart::content();
        return view('layouts.frontend.includes.profile',compact('cartItems','user'));
    }

    public function ubahProfile(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->jenis_identitas = $request->jenis_identitas;
        $user->no_identitas = $request->no_identitas;
        $user->alamat = $request->alamat;
        $user->save();
        toastr()->success('berhasil mengubah profile');   
        return back();
    }

    public function ubahPasswordUser($id){
        $user = User::findOrFail($id);
        $cartItems = Cart::content();
        return view('layouts.frontend.includes.ubahPassword',compact('user','cartItems'));
    }

    public function updatePassword(Request $request, $id){
        $this->validate($request,[
            'password' => 'required|confirmed'
        ]);
            
        $user = User::findOrFail($id);        
        $user->password = Hash::make($request->password);
        $user->save();
        toastr()->success('password berhasil diubah');   
        return redirect()->route('profile');
    }
}
