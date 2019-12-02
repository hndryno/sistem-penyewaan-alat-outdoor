<?php

namespace App\Http\Controllers\Admin;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Barang;
use App\Log;
use PDF;
use Auth;
use App\User;

class TransaksiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $no = 1;
        $tanggal_sekarang =  Carbon::parse(now()->format('Y-m-d'));
        $transaksis = Transaksi::where('status_pembayaran', 1)->get();
        return view('admin.transaksi.index',compact('transaksis', 'no', 'tanggal_sekarang'));
    }

    public function transaksiBank()
    {
        $no = 1;
        $tanggal_sekarang =  Carbon::parse(now()->format('Y-m-d'));
        $transaksis = Transaksi::where('metode_pembayaran', 2)->get();
        return view('admin.transaksi.bank',compact('transaksis', 'no', 'tanggal_sekarang'));
    }

    public function bermasalah()
    {
        $no = 1;
        $tanggal_sekarang =  Carbon::parse(now()->format('Y-m-d'));
        $transaksis = Transaksi::where('status_pembayaran', 0)->get();
        return view('admin.transaksi.bermasalah',compact('transaksis', 'no', 'tanggal_sekarang'));
    }

    public function all(){
        $no = 1;
        $tanggal_sekarang =  Carbon::parse(now()->format('Y-m-d'));
        $transaksis = Transaksi::all();
        return view('admin.transaksi.all',compact('transaksis', 'no', 'tanggal_sekarang'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barang_id = $transaksi->barang_id;
        $barang = Barang::where('id', $barang_id)->first();
        $tanggal_sewa =  Carbon::parse($transaksi->tanggal_sewa)->format('Y-m-d');
        $tanggal_sekarang =  Carbon::parse(now()->format('Y-m-d'));
        $tanggal_kadaluarsa = Carbon::parse($transaksi->tanggal_sewa)->addDays(15)->endOfDay()->format('Y-m-d');
        $tanggal_kadaluarsa_parse = Carbon::parse($tanggal_kadaluarsa);
        $kondisi = $tanggal_kadaluarsa_parse->diffInDays($tanggal_sewa, true);
        // if($tanggal_sekarang == $tanggal_kadaluarsa_parse){
        //     return 'berhasil';
        // }else{
        //     return 'gagal';
        // }
        $tanggal_sekarang =  Carbon::parse(now()->format('Y-m-d'));
        $tanggal_kembali = Carbon::parse($transaksi->tanggal_kembali);
        $hari_telat = $tanggal_kembali->diffInDays($tanggal_sekarang, true);
        // return $hari_telat;

        return view('admin.transaksi.lihat', compact('transaksi', 'tanggal_sekarang','hari_telat'));
    }

    public function edit(Transaksi $transaksi)
    {
        //
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    public function destroy($id)
    {
        $admin = Transaksi::findOrFail($id);
        $barang = Barang::where('id', $admin->barang_id)->first();
        $barang->stock = $barang->stock + $admin->qty;
        $barang->save();
        $admin->delete();
        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('transaksi.index');
    }

    public function statusOrder(Request $request, $id)
    {
        $status = Transaksi::find($id);
        $barang = Barang::where('id',$status->barang_id)->first();
        if($status->metode_pembayaran == 0){
            Alert::toast('User belum melakukan pembayaran!', 'warning');
            return back();
        }else{
            $status->status_barang = $request->status_barang;
            $status->save();
            toastr()->success('Status barang berhasil diupdate!');  
        }
    	return back();
    }

    public function konfirmasi(Request $request, $id)
    {
        $status = Transaksi::find($id);
        $barang = Barang::where('id',$status->barang_id)->first();
        if($status->metode_pembayaran == 0){
            Alert::toast('User belum melakukan pembayaran!', 'warning');
            return back();
        }else{
            if($status->konfirmasi == 1){
                $status->konfirmasi = $request->konfirmasi;
                $status->status_pembayaran = 0;
            }else{
                $status->konfirmasi = $request->konfirmasi;
                $status->status_pembayaran = 1;            
            }
        }
        
        $status->save();
        toastr()->success('Konfirmasi admin berhasil diupdate!');        

    	return back();
    }

    public function denda(Request $request, $id)
    {
        return $request->all();
    }

    public function log()
    {
        $no = 1;
        $tanggal_sekarang =  Carbon::parse(now()->format('Y-m-d'));
        $logs = Log::all();
        return view('admin.transaksi.log',compact('logs','no','tanggal_sekarang'));
    }

    public function selesai($id){        
        $admin = Transaksi::findOrFail($id);
        // return $admin;
        $tanggal_sekarang = Carbon::parse(now()->format('Y-m-d'));
        $tanggal_kembali = Carbon::parse($admin->tanggal_kembali);
        $status = $tanggal_sekarang > $tanggal_kembali;
        if($admin->tanggal_kembali > $tanggal_sekarang){
            $denda = 0;
        }
        else{
            $denda = $tanggal_kembali->diffInDays($admin->tanggal_sekarang, true);
        }
        $barang = Barang::where('id', $admin->barang_id)->first();
        $barang->stock = $barang->stock + $admin->qty;
        $barang->save();
        $log = new Log;
        $log->user_id = $admin->user_id; 
        $log->barang_id = $admin->barang_id;
        $log->metode_pembayaran = $admin->metode_pembayaran;
        $log->status_barang = $admin->status_barang;
        $log->status_pembayaran = $admin->status_pembayaran;
        $log->bukti_pembayaran = $admin->bukti_pembayaran;
        $log->hari_sewa = $admin->hari_sewa;
        $log->harga_barang = $admin->harga_barang;
        $log->konfirmasi = $admin->konfirmasi;
        $log->qty = $admin->qty;    
        $log->total = $admin->total;
        $log->tanggal_sewa = $admin->tanggal_sewa;
        $log->tanggal_kembali = $admin->tanggal_kembali;
        $log->denda = $denda * 10000;
        $log->save();
        $admin->delete();
        return back();
    }

    public function hapusLog($id)
    {
        $log = Log::findOrFail($id);
        $log->delete();
        toastr()->success('Data berhasil dihapus!');        
        return view('admin.transaksi.log');
    }

    public function cetak_pdf(){
        $tanggal_sekarang =  Carbon::now()->format('Y-m-d');
        // $tanggal_sekarang = Carbon\Carbon::now();
        $logs = Log::all();
        $user = Auth::user();
        return view('admin.transaksi.print',compact('logs','tanggal_sekarang','user'));
    }

    public function dataTransaksi(){
        $no = 1;
        // $users = User::join('transaksis','user_id', '=', 'users.id')->select('users.name','users.id')->get();
        $transaksis = Transaksi::get('kode_transaksi');
        $transaksis = $transaksis->unique('kode_transaksi');
        return view('admin.transaksi.userTransaksi',compact('transaksis','no'));
    }

    public function userTransaksiShow($kode_transaksi){
        $tanggal_sekarang =  Carbon::now()->format('Y-m-d');
        $no = 1;
        $transaksis = Transaksi::where('kode_transaksi',$kode_transaksi)->get();
        $metode_pembayaran = Transaksi::where('kode_transaksi',$kode_transaksi)->first('metode_pembayaran');
        $kode_transaksi = Transaksi::where('kode_transaksi',$kode_transaksi)->first('kode_transaksi');
        // $user_transaksi = Transaksi::where('user_id',$id)->first();
        return view('admin.transaksi.userTransaksiShow',compact('transaksis','no','tanggal_sekarang','kode_transaksi','metode_pembayaran'));
    }

    public function dataDenda(){
        $users = User::join('logs','user_id', '=', 'users.id')->select('users.name','users.id')->get();
        $users = $users->unique('name');
        $no = 1;
        return view('admin.transaksi.userDenda',compact('users','no'));

        $user_transaksi = Transaksi::where('user_id',$id)->first();
        $no = 1;
        $logs = Log::where('user',$user_transaksi->name)->get();
        return view('admin.transaksi.lihatDendaUser',compact('logs','no'));
        $tanggal_sekarang = Carbon::parse(now()->format('Y-m-d'));
        $tanggal_kembali = Carbon::parse($transaksis->tanggal_kembali);
        $status = $tanggal_sekarang > $tanggal_kembali;
        if($transaksis->tanggal_kembali > $tanggal_sekarang){
            $denda = 0;
        }
        else{
            $denda = $tanggal_kembali->diffInDays($transaksis->tanggal_sekarang, true);
        }
        return $transaksis;
    }

    public function userDendaShow($id){
        $tanggal_sekarang =  Carbon::now()->format('Y-m-d');
        $no = 1;
        $transaksis = Log::where('user_id',$id)->get();
        $user_log = Log::where('user_id',$id)->first();
        return view('admin.transaksi.userLogShow',compact('transaksis','no','tanggal_sekarang','user_log'));
    } 
    
    public function selesaiSemua($kode_transaksi){
        return $kode_transaksi;
        $auth_id = Auth::user()->id;
        $transaksi = Transaksi::where('user_id', $auth_id);
        $data_transaksi = $transaksi->where('status_pembayaran', 0)->update(['metode_pembayaran' => '1', 'bukti_pembayaran' => 'dibayar tunai ke admin']);
        toastr()->success('terimakasih telah melakukan pembayaran, harap menunggu konfirmasi dari admin, konfirmasi dari admin akan muncul dimenu pesanan'); 
        return back();
    }

    public function perhitunganDenda($kode_transaksi){
        $no = 1;
        $kode_transaksi = $kode_transaksi;
        $nama_user = 
        $tanggal_sekarang =  Carbon::parse(now()->format('Y-m-d'));
        $transaksis = Transaksi::where('kode_transaksi',$kode_transaksi)->get();
        $jumlah_transaksi = $transaksis->count();
        $jumlah_pengembalian = $transaksis->sum('pengembalian_barang');
        $tanggal_kembali = Transaksi::where('kode_transaksi',$kode_transaksi)->get('tanggal_kembali');
        return view('admin.transaksi.tampilDenda', compact('transaksis','no','tanggal_sekarang','kode_transaksi','jumlah_pengembalian','jumlah_transaksi'));
    }

    public function transaksiSelesai(Request $request){
        $kode_transaksi = $request->kode_transaksi;
        $transaksi_selesai = Transaksi::where('kode_transaksi', $kode_transaksi)->get();
        $transaksi_stock = Transaksi::where('kode_transaksi', $kode_transaksi)->get('qty');
        $log_transaksi = New Log; 
        foreach($transaksi_selesai as $transaksi)
        {
            $log_transaksi = Log::create([
                'user_id' => $transaksi->user_id,
                'barang_id' => $transaksi->barang_id,
                'kode_transaksi' => $kode_transaksi,
                'metode_pembayaran' => $transaksi->metode_pembayaran,
                'qty' => $transaksi->qty,
                'status_barang' => $transaksi->status_barang,
                'status_pembayaran' => $transaksi->status_pembayaran,
                'harga_barang' => $transaksi->harga_barang,
                'bukti_pembayaran' => $transaksi->bukti_pembayaran,
                'konfirmasi' => 0,
                'total' => $transaksi->total,
                'hari_sewa' => $transaksi->hari_sewa,
                'tanggal_sewa' => $transaksi->tanggal_sewa,
                'tanggal_kembali' => $transaksi->tanggal_kembali,
                ]);
            }
        $log_transaksi->save();
        Transaksi::where('kode_transaksi', $kode_transaksi)->get()->each->delete();
        toastr()->success('Terimakasih telah menyelesaikan transaksi!'); 
        return redirect()->route('dataTransaksi');
    }

    public function pengembalian(Request $request, $id){
        $pengembalian = Transaksi::findOrFail($id);
        $barang = Barang::where('id', $pengembalian->barang_id)->first();
        $barang->stock = $barang->stock + $pengembalian->qty;
        $barang->save();
        $pengembalian->pengembalian_barang = $request->pengembalian_barang;
        $pengembalian->save();
        Alert::toast('Pengembalian barang berhasil!', 'success');
        return back();
    }
}