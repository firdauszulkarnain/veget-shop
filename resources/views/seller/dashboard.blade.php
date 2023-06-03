@extends('layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-style text-uppercase mb-1">
                            Jumlah Sayuran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                      @if ($produk < 10)
                          0{{ $produk }}
                      @else
                          {{ $produk }}
                      @endif</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-fw fas fa-leaf fa-2x text-style"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-style text-uppercase mb-1">
                            Pesanan Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                      @if ($masuk < 10)
                          0{{ $masuk }}
                      @else
                          {{ $masuk }}
                      @endif</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sign-in-alt fa-2x text-style"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-style text-uppercase mb-1">Pesanan Terkirim
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    @if ($kirim < 10)
                                       0{{ $kirim }}
                                    @else
                                       {{ $kirim }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sign-out-alt fa-2x text-style"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-style text-uppercase mb-1">
                           Total Invoice</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                        @if ($invoice < 10)
                            0{{ $invoice }}
                        @else
                            {{ $invoice }}
                        @endif</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-receipt fa-2x text-style"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection