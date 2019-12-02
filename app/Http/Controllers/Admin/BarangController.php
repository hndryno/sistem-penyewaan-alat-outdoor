<?php

namespace App\Http\Controllers\Admin;

use App\Barang;
use App\Kategori;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $no = 1;
        $barangs = Barang::all();
        return view('admin.barang.index', compact('barangs','no'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.show',compact('barang'));
    }


    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.barang.tambah',compact('kategoris'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'kategori_id' => 'required',
            'nama_alat' => 'required',
            'gambar' => 'required',
            'stock' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
        ]);

        $barang = new Barang;
        $barang->kategori_id = $request->kategori_id;
        $barang->nama_alat = $request->nama_alat;
        if($request->hasFile('gambar'))
        {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/gambar');
            $request->file('gambar')->move($location, $filename);
            $barang->gambar = $filename;
        }
        $barang->stock = $request->stock;
        $barang->harga = $request->harga;
        $barang->keterangan = $request->keterangan;
        if($barang->save()){
            Alert::toast('Data berhasil ditambah', 'success');
        }else{
            Alert::toast('Data gagal ditambah', 'warning');
        }
        return redirect()->route('barang.index');

    }

    public function edit($id)
    {
        $kategoris = Kategori::all();
        $barang = Barang::findOrFail($id);
        return view('admin.barang.ubah',compact('barang','kategoris'));
    }


    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'kategori_id' => 'required',
            'nama_alat' => 'required',
            'stock' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->kategori_id = $request->kategori_id;
        $barang->nama_alat = $request->nama_alat;
        if($request->hasFile('gambar'))
        {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $location = public_path('/gambar');
            $file->move($location, $filename);
            $oldImage = $barang->gambar;
            \Storage::delete($oldImage);
            $barang->gambar = $filename;
        }
        $barang->stock = $request->stock;
        $barang->harga = $request->harga;
        $barang->keterangan = $request->keterangan;
        if($barang->save()){
            Alert::toast('Data berhasil ditambah', 'success');
        }else{
            Alert::toast('Data gagal ditambah', 'warning');
        }
        return redirect()->route('barang.index');
    }


    public function destroy($id)
    {
        $barang = Barang::find($id);
        \Storage::delete($barang->gambar);
        $barang->delete();
        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('barang.index');
    }
}
