@extends('layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Data Pesanan</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card border-top-primary">
            <div class="card-body">
                <table class="table table-striped table-bordered bg-white" id="mytabel" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Nomor Pesanan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tgl. Pesanan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $row)
                            <tr class="text-center">
                                <td></td>
                                <td>{{ $row->no_pesanan }}</td>
                                <td>Rp. {{ number_format($row->total, 0, ',', '.') }}</td>
                                <td>{{ date("d-m-Y", strtotime($row->tgl_pesan)) }}</td>
                                @if ($row->status == 1)
                                    <td> <span class="badge badge-danger">Menunggu Pembayaran</span></td>
                                @elseif ($row->status == 2)
                                    <td> <span class="badge badge-danger">Konfirmasi Pembayaran</span></td>
                                @elseif($row->status == 3)
                                    <td> <span class="badge badge-success">Kirim Pesanan</span></td>
                                @elseif($row->status == 4)
                                    <td> <span class="badge badge-primary">Konfirmasi Pesanan Selesai</span></td>
                                @endif
                                <td>
                                    @if (auth()->user()->role == 1)
                                    <a href="{{ route('admin.detpes', $row->no_pesanan) }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-search"></i></i></a>
                                    @else
                                    <a href="{{ route('seller.detpes', $row->no_pesanan) }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-search"></i></i></a>
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
@endsection
