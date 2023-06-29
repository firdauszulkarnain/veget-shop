@extends('layouts.shop')


@section('content')
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section st-color container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>Keranjang Belanja</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->
    
        <!-- Shoping Cart Section Begin -->
        <section class="shoping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                       
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Produk</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @if ($totalCart != 0)
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <img src="{{ asset('storage/'. $item->produk->foto_produk) }}" alt="" width="20%">
                                                    <h5 class="text-capitalize"><a href="{{ route('detail_produk', $item->produk->id) }}" class="text-decoration-none text-dark">{{ $item->produk->nama_produk }}</a></h5>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    Rp. {{ number_format($item->produk->harga_produk, 0, ',', '.') }}
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <form action="{{ route('update_qty', $item->id) }}" method="POST">
                                                            @csrf
                                                            <div class="pro-qty">
                                                                <input type="text" value="{{ $item->qty }}" name="qty" autocomplete="off" readonly>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    Rp. {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <form action="{{ route('delete_qty', $item->id) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="icon_close border-0 rounded-circle btn btn-light" type="submit"></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @else
                                    <tbody>
                                        <td colspan="4">Tidak Ada Sayuran Dalam Keranjang</td>
                                    </tbody>
                                    @endif
                            </table>
                        </div>
                    </div>
                </div>
                @if ($totalCart != 0)
                <div class="row">
                    <div class="col-lg-7">
                        <div class="shoping__cart__btns">
                            <a href="{{ route('shop') }}" class="primary-btn cart-btn">Toko</a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="shoping__checkout mt-n1">
                            <h5>Total Keranjang</h5>
                            <ul>
                                <li>Subtotal <span> Rp. {{ number_format($subtotal, 0, ',', '.') }}</span></li>
                                <li>Total <span> Rp. {{ number_format($subtotal, 0, ',', '.') }}</span></li>
                            </ul>
                            <a href="/shop/konfirmasi-pesanan" class="primary-btn">Proses Pesanan</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- Shoping Cart Section End -->
@endsection