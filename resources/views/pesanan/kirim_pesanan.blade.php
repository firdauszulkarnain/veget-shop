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
                                <td class="align-middle">Rp. {{ number_format($row->total, 0, ',', '.') }}</td>
                                <td class="align-middle">
                                    {{-- <form action="{{ route('kirim_pesanan', $row->no_pesanan) }}" method="POST" class="d-inline">
                                        @method('PUT')
                                        @csrf
                                        <button class="btn btn-primary btn-sm tombol-kirim d-inline"><i class="fas fa-caravan"></i></button>
                                    </form> --}}
                                    <a href="#" data-id="{{ $row->id }}" data-invoice="{{ $row->no_pesanan }}" data-toggle="modal" data-target="#invoice" class="btn btn-sm btn-primary modalInvoice"> <i class="fas fa-fw fa-caravan"></i></a>
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

<div class="modal fade" id="invoice" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">INVOICE PESANAN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
                <table id="main">
                    <tr style="background-color: #acacac">
                        <td colspan="4" class="text-center">
                            <p style="color: #0b3005;"><b>MAI SAYUR</b></p>
                            <h4 id="no_pesanan" style="margin-top: -15px;"></h4>
                        </td>
                    </tr>
                    <tr>
                        <td width='30%'>
                            <b>Pembayaran</b>
                        </td>
                        <td>
                            <span id="metode" class="font-weight-bolder"></span>
                        </td>
                    </tr>
                    <tr>
                        <td width='30%'>
                            <b>Nama</b>
                        </td>
                        <td>
                            <span id="nama_penerima"></span>
                        </td>
                    </tr>
                    <tr>
                        <td width='30%'>
                            <b>No Telp</b>
                        </td>
                        <td>
                            <span id="notelp_penerima"></span>
                        </td>
                    </tr>
                    <tr>
                        <td width='30%'>
                            <b>Alamat</b>
                        </td>
                        <td>
                            <span id="alamat_penerima"></span>
                        </td>
                    </tr>
                   
                </table>
                <table id="main">
                    <tr id="detail">
                      <td>No</td>
                      <td>Nama Sayuran</td>
                      <td>Qty</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                         <b>Total</b>
                        </td>
                        <td> <b id="total"></b></td>
                     </tr>
                </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-secondary" id="unduhPdf" href="">Unduh Invoice</a>
          <form action="" method="POST" class="d-inline" id="kirim">
            @method('PUT')
            @csrf
            <button class="btn btn-style">Kirim Pesanan</button>
           </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).on("click", ".modalInvoice", function() {
       var id = $(this).data('id');
       var noPesanan = $(this).data('invoice');
       var url = "/pesanan_invoice/"+id;
       $.ajax({
           type: "get",
           url: url,
           dataType: "html",
           success: function(msg) {
            let tmp = JSON.parse(msg);
            $('#no_pesanan').html(tmp.no_pesanan);
            $('#metode').html(tmp.metode);
            $('#nama_penerima').html(tmp.nama_penerima);
            $('#notelp_penerima').html(tmp.notelp_penerima);
            $('#alamat_penerima').html(tmp.alamat_penerima);
            $('#total').html(tmp.total);
            $('#detail').after(tmp.detail);
            $('#unduhPdf').attr('href', '/invoice/pdf/'+id)
            $('#kirim').attr('action', '/pesanan/kirim/'+noPesanan)
           }    
       });
   });

   $("#close").on("click", function() {
        $('[id="sayur"]').remove();
    });
</script>

@endsection
