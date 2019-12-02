<?php

namespace App\Http\Controllers\Admin;

use App\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $no = 1;
        $kategoris = Kategori::all();
        return view('admin.kategori.index',compact('kategoris','no'));
    }
    
    public function store(Request $request)
    {
        $validasi = $this->validate($request, [
            'kategori' => 'required|max:50',
        ]);

        $kategori = new Kategori;
        $kategori->kategori = $request->kategori;
        if($kategori->save()){
            Alert::toast('Data berhasil ditambahkan', 'success');
        }else{
            Alert::toast('Data gagal ditambahkan', 'warning');
        }
        return redirect()->route('kategori.index');
    }
    
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.ubah',compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $validasi = $this->validate($request, [
            'kategori' => 'required|max:50',
        ]);
        $kategori->kategori = $request->kategori; 
        if($kategori->save()){
            Alert::toast('Data berhasil diubah', 'success');
        }else{
            Alert::toast('Data gagal diubah', 'warning');
        }
        return redirect()->route('kategori.index');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        if($kategori->delete()){
            Alert::toast('Data berhasil dihapus!', 'success');
        }
        
        return redirect()->route('kategori.index');
    }
}
