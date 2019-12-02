<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Cart;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cartItems = Cart::content();
        $barangs = Barang::all();
        return view('layouts.frontend.beranda.index',compact('barangs','cartItems'));
    }
}
