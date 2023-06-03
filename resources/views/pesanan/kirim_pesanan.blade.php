@extends('layouts.main')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Data Kirim Pesanan</h1>
</div>


<div class="row mb-5">
    <div class="col-lg-12">
        <div class="card border-top-primary">
            <div class="card-body">
                <table class="table table-striped table-bordered order-column" id="mytabel" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Tgl. Pesanan</th>
                            <th scope="col">Nomor Pesanan</th>
                            <th scope="col">Tipe Pembayaran</th>
                            {{-- <th scope="col">Kabupaten</th>
                            <th scope="col">Kecamatan</th> --}}
                            <th scope="col">Total</th>
                            <th scope="col" width="12%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $row)
                            <tr class="text-center">
                                <td></td>
                                <td class="align-middle">{{ $row->tgl_pesan }}</td>
                                <td class="align-middle">{{ $row->no_pesanan }}</td>
                                <td class="align-middle">
                                    @if ($row->tipe_pembayaran == 1)
                                        <span class="badge badge-primary">COD(<i>Cash On Delivery</i>)</span>
                                    @else
                                        <span class="badge badge-warning">Bank Transfer</span>
                                    @endif
                                </td>
                                {{-- <td class="align-middle">{{ $row->pengiriman->kabupaten->nama_kab }}</td> --}}
                                {{-- <td class="align-middle">{{ $row->pengiriman->kecamatan->nama_kec }}</td> --}}
                                <td class="align-middle">Rp. {{ number_format($row->total, 0, ',', '.') }}</td>
                                <td class="align-middle">
                                    <form action="{{ route('kirim_pesanan', $row->no_pesanan) }}" method="POST" class="d-inline">
                                        @method('PUT')
                                        @csrf
                                        <button class="btn btn-primary btn-sm tombol-kirim d-inline"><i class="fas fa-caravan"></i></button>
                                    </form>
                                    <a href="{{ route('seller.detpes', $row->no_pesanan) }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-search"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
