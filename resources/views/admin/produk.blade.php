@extends('layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Master Data Sayuran</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card border-top-primary">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="mytabel" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Sayuran</th>
                            <th scope="col">Harga 100g</th>
                            <th scope="col">Harga 500g</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Toko</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $row)
                            <tr class="text-center">
                                <td></td>
                                <td class="text-capitalize">{{ $row->nama_produk }}</td>
                                <td>Rp. {{ number_format($row->harga_produk1, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($row->harga_produk2, 0, ',', '.') }}</td>
                                <td>
                                    @if ($row->stock_produk == 1)
                                        <span class="badge badge-primary">Available</span>
                                    @else
                                        <span class="badge badge-danger">Not Available</span>
                                    @endif
                                </td>
                                <td class="text-capitalize">{{ $row->store->nama_toko }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
