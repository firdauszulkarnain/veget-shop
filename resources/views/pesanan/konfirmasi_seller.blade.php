@extends('layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Konfirmasi Pesanan</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card border-top-primary">
            <div class="card-body">
                <table class="table table-striped table-bordered bg-white" id="mytabel" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Tgl. Pesanan</th>
                            <th scope="col">Nomor Pesanan</th>
                            <th scope="col">Tipe Pembayaran</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $row)
                            <tr class="text-center">
                                <td></td>
                                <td>{{ $row->tgl_pesan }}</td>
                                <td>{{ $row->no_pesanan }}</td>
                                <td>
                                    @if ($row->tipe_pembayaran == 1)
                                        <span class="badge badge-primary">COD (<i>Cash On Delivery</i>)</span>
                                    @else
                                        <span class="badge badge-warning">Bank Transfer</span>
                                    @endif
                                </td>
                                <td>Rp. {{ number_format($row->total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="#" data-id="{{ $row->id }}" data-toggle="modal" data-target="#updateStatus" class="btn btn-sm btn-dark update-status">Konfirmasi</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade mt-5" id="updateStatus" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pesanan Tiba</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" id="formUpdate">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tgl_bayar">Tanggal Bayar</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control bg-light" name="tgl_bayar" value="{{ old('tgl_bayar') }}" id="tgl_bayar" placeholder="dd-mm-yyyy" autocomplete="off" required>
                                <div class="input-group-append">
                                  <span class="input-group-text px-3 st-color" id="basic-addon2"><i class="fas fa-fw fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bukti_bayar">Bukti Pesanan Selesai</label>
                            <input type="file" class="input-file bg-light" id="up_kec" name="bukti_bayar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn px-4 py-2">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    $(document).on("click", ".update-status", function() {
        var id = $(this).data('id');
        $("#formUpdate").attr('action', '/pesanan/konfirmasi_seller/'+id);
    });

   
    var dateToday = new Date(); 
        $('#tgl_bayar').datepicker({
        todayBtn: "linked",
        orientation: "bottom auto",
        todayHighlight: true,
        // startDate: new Date(),
        autoHide: true,
        format: 'dd-mm-yyyy',
    });
   
    </script>
@endsection
