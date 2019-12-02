<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class ManajemenUserController extends Controller
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
        $users = User::all();
        return view('admin.manajemenuser.index',compact('users','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manajemenuser.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name' => 'required',
        //     'no_identitas' => 'required',
        //     'telepon' => 'required',
        //     'email' => 'required',
        //     'password' => 'required|confirmed'
        // ]);

        $user = new User;
        $user->no_identitas = $request->no_identitas;
        $user->name = $request->name;
        $user->telepon = $request->telepon;
        $user->alamat = $request->alamat;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            Alert::toast('Data berhasil ditambah', 'success');
        }else{
            Alert::toast('Data gagal ditambah', 'warning');
        }
        return redirect()->route('manajemenuser.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ManajemenUser  $manajemenUser
     * @return \Illuminate\Http\Response
     */
    public function show(ManajemenUser $manajemenUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManajemenUser  $manajemenUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manajemenuser.ubah', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ManajemenUser  $manajemenUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);        
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            Alert::toast('Data berhasil diubah', 'success');
        }else{
            Alert::toast('Data gagal diubah', 'warning');
        }
        return redirect()->route('manajemenuser.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManajemenUser  $manajemenUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManajemenUser $manajemenUser)
    {
        //
    }
}
