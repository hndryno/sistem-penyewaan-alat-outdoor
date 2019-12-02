<?php

namespace App\Http\Controllers\Admin;

use App\ManajemenAdmin;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $admins = Admin::all();
        return view('admin.manajemenadmin.index',compact('admins','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manajemenadmin.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        if($admin->save()){
            Alert::toast('Data berhasil ditambah', 'success');
        }else{
            Alert::toast('Data gagal ditambah', 'warning');
        }
        return redirect()->route('manajemenadmin.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ManajemenAdmin  $manajemenAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(ManajemenAdmin $manajemenAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManajemenAdmin  $manajemenAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.manajemenadmin.ubah',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ManajemenAdmin  $manajemenAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);        
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        if($admin->save()){
            Alert::toast('Data berhasil diubah', 'success');
        }else{
            Alert::toast('Data gagal diubah', 'warning');
        }
        return redirect()->route('manajemenadmin.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManajemenAdmin  $manajemenAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('manajemenadmin.index');
    }
}
