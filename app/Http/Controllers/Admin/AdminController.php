<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Barang;
use App\Kategori;
use App\Transaksi;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $barang = Barang::all();
        $kategori = Kategori::all();
        $pending = Transaksi::where('status_barang',1)->get();
        $dipinjamkan = Transaksi::where('status_barang',0)->get();
        $jumlah_pending = count($pending);
        $jumlah_dipinjamkan = count($dipinjamkan);
        $jumlah_barang = count($barang);
        $jumlah_kategori = count($kategori);
        return view('admin.dashboard',compact('jumlah_barang','jumlah_kategori','jumlah_pending','jumlah_dipinjamkan'));
    }
}
