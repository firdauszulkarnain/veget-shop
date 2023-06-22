    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="/"><img src="{{ asset('/dist/img/logo5.png') }}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="/keranjang"><i class="fa fa-shopping-bag"></i> <span>{{ $totalCart }}</span></a></li>
                <li>
                    @if (auth()->check())
                        <a href="{{ route('profile') }}" class="text-decoration-none text-dark"><i class="fa fa-user"></i> {{ auth()->user()->username }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-decoration-none text-dark"><i class="fa fa-user"></i> Login</a>
                    @endif
                </li>
            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
            </div>
            <div class="header__top__right__auth">
                
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                @if (auth()->check())
                    @if (auth()->user()->role != 1)
                        <li class="{{ Request::is('pesanan-saya') ? 'active' : '' }}"><a href="{{ route('pesanan_saya') }}">Pesanan Saya</a></li>
                    @endif
                @endif
                <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="{{ Request::is('shop') ? 'active' : '' }}"><a href="{{ route('shop') }}">Toko</a></li>
                <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">Tentang</a></li>
                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Hubungi Kami</a></li>
                @if (auth()->check())
                <li ><a href="{{ route('logout') }}">Logout</a></li>
                @endif
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social"></div>
        <div class="humberger__menu__contact">
            <ul></ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top" style="background-color: #0B3005 !important">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                          <ul>  <li>   <a href="/"><img src="{{ asset('/dist/img/logo6.png') }}" alt="" width="40%"></a></li></ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mt-2 te">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="{{ route('home') }}">Beranda</a>
                                <a href="{{ route('shop') }}">Toko</a>
                                <a href="{{ route('contact') }}">Hubung Kami</a>
                                <a href="{{ route('about') }}">Tentang</a>
                                <a href="/shop/keranjang" ><i class="fa fa-shopping-bag"></i> <span>{{ $totalCart }}</span></a>
                            </div>
                            <div class="header__top__right__auth ">
                                @if (auth()->check())
                                    <div class="dropdown container ml-n3">
                                        <a class="dropdown-toggle container" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <span class="text-capitalize"><i class="fa fa-user"></i>{{ auth()->user()->username }}</span>
                                        </a>

                                        <div class="dropdown-menu container">
                                            @if (auth()->user()->role != 1)
                                            <a class="dropdown-item text-dark" id="user-dropdown" href="{{ route('profile') }}">Profil Saya</a>
                                            @endif
                                            @if (auth()->user()->role == 2)
                                            <a class="dropdown-item text-dark" id="user-dropdown" href="{{ route('seller.dashboard') }}">Dashboard</a>
                                            @endif
                                            @if (auth()->user()->role == 1)
                                            <a class="dropdown-item text-dark" id="user-dropdown" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                            @endif
                                            @if (auth()->user()->role != 1)
                                            <a class="dropdown-item text-dark" id="user-dropdown" href="/pesanan-saya">Pesanan Saya</a>
                                            @endif
                                            <form action="/logout" method="POST">
                                                @csrf
                                                <button class="dropdown-item" id="user-dropdown" style="font-size: 14px !important;">Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <a href="/login" class="ml-3"><i class="fa fa-user"></i> Login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mb-5">
                {{-- <div class="col-lg-3">
                    <div class="header__logo">
                    <a href="/"><img src="{{ asset('/dist/img/logo5.png') }}" alt="" width="100%"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu text-center mt-2">
                        <ul>
                            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                            <li class="{{ Request::is('shop*') ? 'active' : '' }}"><a href="{{ route('shop') }}">Shop</a></li>
                            <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About</a></li>
                            <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart mt-2">
                        <ul>
                            <li><a href="/shop/keranjang"><i class="fa fa-shopping-bag"></i> <span>{{ $totalCart }}</span></a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->