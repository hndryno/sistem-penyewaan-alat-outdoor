<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
    <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
        <div class="profile-image">
            <img class="img-xs rounded-circle" src="{{asset('backend/images/faces/face8.jpg')}}" alt="profile image">
            <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
            <p class="profile-name">{{Auth::user()->name}}</p>
            <p class="designation">Administrator</p>
        </div>
        </a>
    </li>
    <li class="nav-item nav-category">
        <span class="nav-link">Menu Utama</span>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
        <span class="menu-title">Dashboard</span>
        <i class="icon-screen-desktop menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{route('kategori.index')}}">
        <span class="menu-title">Kategori</span>
        <i class=" icon-list menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('barang.index')}}">
        <span class="menu-title">Barang</span>
        <i class="icon-bag menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#transaksi" aria-expanded="false" aria-controls="transaksi">
        <span class="menu-title">Manajemen Transaksi</span>
        <i class="icon-basket-loaded menu-icon"></i>
        </a>
        <div class="collapse" id="transaksi">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('dataTransaksi')}}">Data Transaksi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('dataDenda')}}">Denda User</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('all')}}">Semua Transaksi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('transaksi.index')}}">Transaksi Lunas</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('transaksi.bermasalah')}}">Transaksi Belum Lunas</a></li>
        <li class="nav-item"> <a class="nav-link" href="{{route('transaksiBank')}}">Bank Transfer</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('log')}}">Log Transaksi</a></li>
        </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-title">Manajemen User</span>
        <i class="icon-people menu-icon"></i>
        </a>
        <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('manajemenuser.index')}}"> User </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('manajemenadmin.index')}}"> Admin </a></li>
        </ul>
        </div>
    </li>
    </ul>
</nav>
