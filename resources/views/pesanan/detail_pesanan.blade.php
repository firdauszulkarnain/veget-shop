@extends('layouts.main')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Detail Pesanan</h1>
</div>

<div class="row mb-5">
    <div class="col-lg-5">
        <div class="card border-left-primary shadow mb-3">
            <div class="card-body" style="max-height: 100px !important;">
                <h5 class="font-weight-bolder text-style">{{ $pesanan->no_pesanan }}</h5>
                <p>Tgl Pesanan: {{  date("d-m-Y", strtotime($pesanan->tgl_pesan) ); }}</p>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header font-weight-bolder bg-primary text-light">
                Detail Pengiriman
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_penerima" class="font-weight-normal">Nama Penerima</label>
                    <input type="text" class="form-control text-capitalize bg-light" id="nama_penerima" name="nama_penerima" value="{{ $pesanan->pengiriman->nama_penerima }}" disabled>
                </div>
                <div class="form-group">
                    <label for="notelp_penerima" class="font-weight-normal">No.Telp Penerima</label>
                    <input type="text" class="form-control bg-light" id="notelp_penerima" name="notelp_penerima" value="{{ $pesanan->pengiriman->notelp_penerima }}" disabled>
                </div>
                <div class="form-group">
                    <label for="kab" class="font-weight-normal">Kapubaten Pengiriman</label>
                    <input type="text" class="form-control bg-light" id="kab" name="kab" value="{{ $pesanan->pengiriman->kabupaten->nama_kab }}" disabled>
                </div>
                <div class="form-group">
                    <label for="kec" class="font-weight-normal">Kecamatan Pengiriman</label>
                    <input type="text" class="form-control bg-light" id="kec" name="kec" value="{{ $pesanan->pengiriman->kecamatan->nama_kec }}" disabled>
                </div>
                <div class="form-group">
                    <label for="alaamat">Alamat Pengiriman</label>
                    <textarea class="form-control bg-light" id="alaamat" rows="2" disabled>{{ $pesanan->pengiriman->alamat_penerima }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-header font-weight-bolder bg-primary text-light">
                Detail Pesanan
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="subtotal" class="col-sm-3 col-form-label font-weight-normal">Subtotal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control bg-light" id="subtotal" name="subtotal" value="{{ number_format($pesanan->subtotal, 0, ',', '.') }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ongkir" class="col-sm-3 col-form-label font-weight-normal">Ongkir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control bg-light" id="ongkir" name="ongkir" value="{{ number_format($pesanan->ongkir, 0, ',', '.') }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total" class="col-sm-3 col-form-label font-weight-normal">Total</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control bg-light" id="total" name="total" value="{{ number_format($pesanan->total, 0, ',', '.') }}" disabled>
                    </div>
                </div>
                <table class="table table-striped table-bordered" id="mytabel" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $row)
                            <tr class="text-center">
                                <td></td>
                                <td class="text-capitalize">{{ $row->produk->nama_produk }}</td>
                                <td>{{ $row->qty }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      
    </div>
</div>
@endsection
