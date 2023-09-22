
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">


    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ (auth()->user()->role == 2) ? route('seller.dashboard') : route('admin.dashboard') }}">
        {{-- <div class="sidebar-brand-text mx-3">DASHBOARD</div> --}}
        <img src="{{ asset('/dist/img/logo6.png') }}" alt="" width="90%">
    </a>

    <hr class="sidebar-divider my-0">

    @if (auth()->user()->role == 2)
    <li class="nav-item {{ Request::is('seller*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('seller.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Master Data
    </div>

    <li class="nav-item {{ Request::is('produk*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/produk') }}">
            <i class="fa-fw fas fa-leaf"></i>
            <span>Data Sayuran</span></a>
    </li>

    <li class="nav-item {{ Request::is('ongkir*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/ongkir') }}">
            <i class="fas fa-fw fa-caravan"></i>
            <span>Data Ongkir</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        FITUR UTAMA
    </div>

    <li class="nav-item {{ Request::is('pesanan*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-archive"></i>
            <span>Pesanan</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/pesanan') }}">Data Pesanan</a>
                {{-- <a class="collapse-item" href="{{ route('kirim') }}">Kirim Pesanan</a> --}}
                <a class="collapse-item" href="{{ route('seller.konfirmasi') }}">Konfirmasi Pesanan</a>
            </div>
        </div>
    </li>

    <li class="nav-item  {{ Request::is('invoice*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('seller.invoice') }}">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Laporan</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    @else
     <li class="nav-item {{ Request::is('admin') || Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>


    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Master Data
    </div>

    <li class="nav-item {{ Request::is('admin/produk*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/produk') }}">
            <i class="fa-fw fas fa-leaf"></i>
            <span>Data Sayuran</span></a>
    </li>

    <li class="nav-item  {{ Request::is('admin/user*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pengguna</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/admin/user/customer') }}">Customer</a>
                <a class="collapse-item" href="{{ url('/admin/user/seller') }}">Seller</a>
                <a class="collapse-item" href="{{ url('/admin/user/admin') }}">Administrator</a>
            </div>
        </div>
    </li>
    
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        FITUR UTAMA
    </div>

    {{-- <li class="nav-item {{ Request::is('admin/pesanan*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesTwo"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-archive"></i>
            <span>Pesanan</span>
        </a>
        <div id="collapsePagesTwo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.pesanan') }}">Data Pesanan</a>
                <a class="collapse-item" href="{{ route('admin.konfirmasi') }}">Konfirmasi Pesanan</a>
            </div>
        </div>
    </li> --}}
    <li class="nav-item  {{ Request::is('admin/pesanan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pesanan') }}">
            <i class="fas fa-fw fa-archive"></i>
            <span>Pesanan</span></a>
    </li>

    <li class="nav-item  {{ Request::is('admin/invoice*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.invoice') }}">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>Laporan</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    @endif

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>