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
                                        <th scope="col">Toko</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Tgl. Pesanan</th>
                                        <th scope="col" width = '20%'>Status</th>
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
                                             @if ($row->tipe_pembayaran == 0)
                                            <td> 
                                                <small class="text-danger"><b>Menunggu Konfirmasi Pembayaran oleh Admin 15 Menit - 2 Jam</b></small>
                                            </td>   
                                             @else
                                             <td> <span class="badge badge-warning">Menunggu Pengiriman</span></td>   
                                             @endif
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
                                                    {{-- <form action="{{ route('pesanan_selesai', $row->no_pesanan) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-info btn-sm">Konfirmasi</button>
                                                    </form> --}}
                                                    <button type="button" data-id="{{ $row->no_pesanan }}" class="btn btn-info btn-sm modal_review" data-toggle="modal" data-target="#reviewModal">
                                                        Konfirmasi
                                                    </button>
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

        <!-- Modal -->
    <div class="modal fade" id="reviewModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><b>REVIEW TOKO</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pesanan/INV2309140001" method="POST" id="formReview">
                @csrf
                <div class="modal-body">
                    <p class="text-dark text-center">Berikan Rating Pada Toko</p>
                    <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5"></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"></label>
                    </div>
                    <div class="form-group">
                        <label for="ulasan">Ulasan</label>
                        <textarea class="form-control" id="ulasan" name="ulasan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Konfirmasi</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".modal_review", function() {
        var id = $(this).data('id');
        var url = '/pesanan/'+id;
        alert(url);
        $("#formReview").attr("action", url);

    });
    </script>
@endsection