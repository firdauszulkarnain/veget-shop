@extends('layouts.main')

@section('content')
     <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-style text-uppercase mb-1">
                            Total Sayuran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        @if ($totalProduk < 10)
                            0{{ $totalProduk }}
                        @else
                            {{ $totalProduk }}
                        @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-fw fas fa-leaf fa-2x text-style"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-style text-uppercase mb-1">
                            Total Pelanggan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">  
                        @if ($totalCustomer < 10)
                            0{{ $totalCustomer }}
                        @else
                            {{ $totalCustomer }}
                        @endif</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-style"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-style text-uppercase mb-1">Total Toko
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                @if ($totalStore < 10)
                                    0{{ $totalStore }}
                                @else
                                    {{ $totalStore }}
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-store-alt fa-2x text-style"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-style text-uppercase mb-1">
                            Total Pesanan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if ($totalPesanan < 10)
                                0{{ $totalPesanan }}
                            @else
                                {{ $totalPesanan }}
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-receipt fa-2x text-style"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
@endsection