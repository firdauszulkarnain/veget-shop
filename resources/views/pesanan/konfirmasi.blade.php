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
                            <th scope="col">Nomor Pesanan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tgl. Pesanan</th>
                            <th scope="col">Tgl. Bayar</th>
                            <th scope="col">Bukti Pembayaran</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $row)
                            <tr class="text-center">
                                <td></td>
                                <td>{{ $row->no_pesanan }}</td>
                                <td>Rp. {{ number_format($row->subtotal + $row->ongkir, 0, ',', '.') }}</td>
                                <td>{{ date("d-m-Y", strtotime($row->tgl_pesan)) }}</td>
                                <td>{{ date("d-m-Y", strtotime($row->tgl_bayar)) }}</td>
                                <td>
                                    <a href="javascript:;" data-image="{{ $row->bukti_bayar}}" data-id="{{ $row->order_no }}" data-toggle="modal" data-target="#imgPreview" class="btn btn-sm btn-style px-3 modal-image">
                                        <i class="fas fa-fw fa-eye"></i> View Detail
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('konfirmasi_pembayaran', $row->no_pesanan) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <button class="btn btn-style btn-sm tombol-status"><i class="fas fa-fw fa-check"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="imgPreview" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Foto Bukti Pembayaran <span class="judul_bukti font-weight-bolder"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <img id="foto_bukti" class="img-thumbnail tengah" style="max-width: 100%; max-height: 500px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
<script>
    $(document).on("click", ".modal-image", function() {
        var img = $(this).data('image');
        var imgsrc = '{{ asset("storage") }}' + '/' + img;
        var no_pesanan = $(this).data('id');
        $('#foto_bukti').attr('src', imgsrc);
        $('.judul_bukti').html(no_pesanan);
    });
</script>
@endsection
