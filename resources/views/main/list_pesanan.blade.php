@extends('layouts.shop')


@section('content')
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section st-color container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>Pesanan Saya</h2>
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
                        <div>
                            <table class="table table-striped table-bordered" id="mytabel" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No.</th>
                                        <th scope="col">No. Pesanan</th>
                                        <th scope="col">Store</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Tgl. Pesanan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan as $row)
                                        <tr class="text-center">
                                            <td></td>
                                            <td>{{ $row->no_pesanan }}</td>
                                            <td class="text-capitalize">{{ $row->store->nama_toko }}</td>
                                            <td>Rp. {{ number_format($row->subtotal, 0, ',', '.') }}</td>
                                            <td>{{ date("d-m-Y", strtotime($row->tgl_pesan)) }}</td>
                                            @if ($row->status == 1)
                                                <td> <span class="badge badge-danger">Menunggu Pembayaran</span></td>
                                            @elseif($row->status >= 2 && $row->status < 4)
                                                <td> <span class="badge badge-warning">Menunggu Pengiriman</span></td>
                                            @elseif($row->status == 4)
                                                @if ($row->bukti_bayar == null)
                                                    <td> <span class="badge badge-warning">Menunggu Pengiriman</span></td>
                                                @else
                                                    <td> <span class="badge badge-success">Pesanan Tiba</span></td>
                                                @endif
                                            @else
                                                <td> <span class="badge badge-info">Pesanan Selesai</span></td>
                                            @endif
                                            <td>
                                                @if ($row->status == 1)
                                                <a href="{{ route('pembayaran', $row->no_pesanan) }}"
                                                    class="btn btn-info btn-sm">Bayar Pesanan</a>
                                                @endif
                                                @if ($row->status == 4 && $row->bukti_bayar != null)
                                                    <form action="{{ route('pesanan_selesai', $row->no_pesanan) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-info btn-sm">Konfirmasi</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shoping Cart Section End -->
@endsection