<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">

                <a class="navbar-brand logo_h" href="index.html"><b>DEMONTEN ADVENTURE</b></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item {{ Request::is('beranda') ? 'active' : ''}}"><a class="nav-link" href="{{route('beranda')}}">Beranda</a></li>
                        <li class="nav-item {{ Request::is('produk') ? 'active' : ''}}"><a class="nav-link" href="{{route('produk')}}">Produk</a></li>
                        <li class="nav-item {{ Request::is('hubungi') ? 'active' : ''}}"><a class="nav-link" href="{{route('hubungi')}}">Hubungi</a></li>
                        <li class="nav-item {{ Request::is('syarat') ? 'active' : ''}}"><a class="nav-link" href="{{route('syarat')}}">Syarat</a></li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                            <li class="nav-item {{ Request::is('pendaftaran') ? 'active' : ''}}"><a class="nav-link" href="{{route('daftar')}}">Daftar</a></li>
                        @else
                            <li class="dropdown" style="margin-top: 8px;">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret "></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{route('kodeTransaksi')}}" class="dropdown-item">Pembayaran</a>
                                    <a href="{{route('cekKodeTransaksi')}}" class="dropdown-item">Cek Transaksi</a>
                                    <a href="{{route('profile')}}" class="dropdown-item">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <!-- <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li> -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-cart-plus" style="color: #fff; font-size: 21px;"></i><span class="label label-danger" style="font-size: 14px;"> {{Cart::count()}}</span> <span class="ti-bag"></span></a>
                        <ul class="dropdown-menu dropdown-cart" role="menu" style="margin-top: 8px;">
                        @if($cartItems->isEmpty())
                        <div class="text-center">Keranjang Kosong</div>
                        @else
                            @foreach($cartItems as $cart)
                                <div class="row">
                                    <p style="font-size: 11px; margin-left:10px;" class="col-md-8">{{$cart->name}}
                                    <b>(Rp {{number_format( $cart->price ,0, ',' , '.')}})</b></p>
                                    <form action="{{route('deleteItems',$cart->rowId)}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$cart->options->barang_id}}">
                                        <input type="hidden" name="stock" value="{{$cart->qty}}">
                                        {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-xs btn-danger pull-right">x</button>
                                    </form>
                                </div>
                            @endforeach
                            <li><a class="text-center" href="{{route('lihatPesanan')}}">Lihat Keranjang</a></li>
                        @endif
                        </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between">
            <input type="text" class="form-control" id="search_input" placeholder="Search Here">
            <button type="submit" class="btn"></button>
            <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
