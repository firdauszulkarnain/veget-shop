@extends('layouts.shop')

@section('content')
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg st-color container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Konfirmasi Pesanan</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detail Pesanan</h4>
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <form action="{{ route('pembayaran', $pesanan->no_pesanan) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="no_pesanan">Nomor Pesanan</label>
                                    <input type="text" class="form-control" id="no_pesanan" value="{{ $pesanan->no_pesanan }}" disabled>
                                </div>
                                <label for="">Tanggal Pembayaran</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control  @error('tgl_bayar') border border-danger @enderror" name="tgl_bayar" value="{{ old('tgl_bayar') }}" id="tanggal" placeholder="dd-mm-yyyy" autocomplete="off">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 st-color" id="basic-addon2"><i class="fas fa-fw fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="bukti_bayar">Bukti Pembayaran</label>
                                    <input type="file" class="file-bayar" id="bukti_bayar" name="bukti_bayar">
                                </div>
                                <a href="/shop" class="btn site-btn text-dark border border-secondary" style="background-color: white;">SHOP</a>
                                <button class="btn site-btn float-right">KIRIM</button>
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Pembayaran</h4>
                                <div class="checkout__order__products">Bank <span>Rekening</span></div>
                                <ul>
                                    <li>BCA<span>74394384393</span></li>
                                    <li>MANDIRI<span>74394384393</span></li>
                                    <li>BRI<span>74394384393</span></li>
                                </ul>
                                <p class="text-justify">Pembayaran dapat di transfer pada salah satu daftar rekening diatas.</p>
                            </div>
                            <div class="checkout__order mt-5">
                                <h4>Detail Pesanan</h4>
                                <div class="checkout__order__products">Items <span>Total</span></div>
                                <ul>
                                    @foreach ($items as $item)
                                            <li>{{ $item->produk->nama_produk . ' (x'.  $item->qty . ')' }}  <span>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>Rp. {{ number_format($pesanan->subtotal, 0, ',', '.') }}</span></div>
                                <div class="checkout__order__subtotal mt-n3">Ongkir <span id="ongkir">Rp. {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span></div>
                                <div class="checkout__order__total">Total <span id="total">Rp. {{ number_format($pesanan->total, 0, ',', '.') }}</span></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <script>
        var dateToday = new Date(); 
         $('#tanggal').datepicker({
            todayBtn: "linked",
            orientation: "bottom auto",
            todayHighlight: true,
            // startDate: new Date(),
            autoHide: true,
            format: 'dd-mm-yyyy',
        });
    </script>
@endsection
