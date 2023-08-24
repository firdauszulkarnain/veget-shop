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
                                    <td> <span class="badge badge-danger">Konfirmasi Pembayaran</span>
                                        @if (auth()->user()->role == 1)
                                            <a href="javascript:;" data-image="{{ $row->bukti_bayar}}" data-id="{{ $row->order_no }}" data-toggle="modal" data-target="#imgPreview" class="btn btn-sm btn-style rounded-circle   modal-image">
                                                <i class="fas fa-fw fa-eye"></i>
                                            </a>
                                        @endif
                                    </td>
                                @elseif($row->status == 3)
                                    <td> <span class="badge badge-success">Kirim Pesanan</span></td>
                                @elseif($row->status == 4)
                                    <td> <span class="badge badge-primary">Konfirmasi Pesanan Selesai</span></td>
                                @endif
                                <td>
                                    @if (auth()->user()->role == 1)
                                    <a href="{{ route('admin.detpes', $row->no_pesanan) }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-search"></i></i></a>
                                    @if($row->status == 2)
                                    <form action="{{ route('konfirmasi_pembayaran', $row->no_pesanan) }}" method="POST" class="d-inline">
                                        @method('PUT')
                                        @csrf
                                        <button class="btn btn-primary btn-sm tombol-status"><i class="fas fa-fw fa-check"></i></button>
                                    </form>
                                    @endif
                                    @else
                                    <a href="{{ route('seller.detpes', $row->no_pesanan) }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-fw fa-search"></i></i></a>
                                        @if($row->status == 3)
                                        <a href="#" data-id="{{ $row->id }}" data-invoice="{{ $row->no_pesanan }}" data-toggle="modal" data-target="#invoice" class="btn btn-sm btn-primary modalInvoice"> <i class="fas fa-fw fa-caravan"></i></a>
                                        @endif
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
