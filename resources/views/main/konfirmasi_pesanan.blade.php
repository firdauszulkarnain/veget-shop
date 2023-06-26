@extends('layouts.shop')

@section('content')
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section st-color container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Konfirmasi Pesanan</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detail Pesanan</h4>
                <form action="/shop/proses_pesanan" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <div class="form-group mb-4">
                                <label for="tipe_pembayaran">Tipe Pembayaran</label>
                                <select class="form-control selectpicker border @error('tipe_pembayaran') border-danger @enderror" id="tipe_pembayaran" name="tipe_pembayaran" data-size="4" data-live-search="true" title="Pilih Tipe Pembayaran">
                                    <option value="0" 
                                    @if (old('tipe_pembayaran') == "0")
                                        selected
                                    @endif>Transfer Bank</option>
                                    <option value="1"  @if (old('tipe_pembayaran') == "1")
                                    selected
                                @endif>COD (<i>Cash On Delivery</i>)</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="nama_penerima">Nama Penerima</label>
                                <input type="text" class="form-control @error('nama_penerima') is-invalid @enderror" id="nama_penerima" name="nama_penerima" autocomplete="off" value="{{ old('nama_penerima') }}" autofocus>
                            </div>
                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                  <label for="notelp_penerima">No. Telp Penerima</label>
                                  <input type="text" class="form-control @error('notelp_penerima') is-invalid @enderror" id="notelp_penerima" name="notelp_penerima" value="{{ old('notelp_penerima', auth()->user()->notelp) }}" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="email">Email</label>
                                  <input type="text" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                                </div>
                              </div>
                            <div class="form-group mb-4">
                                <label for="kabupaten">Kabupaten</label>
                                <select class="form-control selectpicker border @error('kabupaten') border-danger @enderror" id="kabupaten" name="kabupaten" data-size="4" data-live-search="true" title="Pilih Kabupaten">
                                    @foreach ($kabupaten as $row)
                                        <option value="{{ $row->kabupaten->id }}">{{ $row->kabupaten->nama_kab }}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control selectpicker border @error('kecamatan') border-danger @enderror" id="kecamatan" name="kecamatan" title="Pilih Kecamatan" data-size="4" data-live-search="true">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="alamat_penerima">Alamat Pengiriman</label>
                                <textarea class="form-control @error('alamat_penerima') border border-danger @enderror" id="alamat_penerima" rows="2" name="alamat_penerima" autocomplete="off">{{ auth()->user()->alamat }}</textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="catatan">Catatan Pesanan</label>
                                <textarea class="form-control @error('catatan') border border-danger @enderror" id="catatan" rows="3" name="catatan" autocomplete="off">{{ old('catatan') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4>Detail Pesanan</h4>
                                <div class="checkout__order__products">Items <span>Total</span></div>
                                <ul>
                                    @foreach ($items as $item)
                                            <li><b class="text-capitalize font-weight-normal">{{ $item->produk->nama_produk }}</b> (x{{ $item->qty }})  <span>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>Rp. {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                                <div class="checkout__order__subtotal mt-n3">Ongkir <span id="ongkir">Rp. {{ number_format(0, 0, ',', '.') }}</span></div>
                                <div class="checkout__order__total">Total <span id="total">Rp. {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                                <button type="submit" class="site-btn">Konfirmasi Pesanan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <script>
        $("#kabupaten").change(function() {
            var id = $(this).val();
            var store = {{ $store }};
            var url = "/kec_checkout";
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                type: "post",
                url: url,
                dataType: "html",
                data: {
                    "_token": token,
                    "id_store": store,
                    "id_kab" : id
                },
                success: function(msg) {
                    // alert('OK');
                    $("#kecamatan").html(msg).selectpicker('refresh');
                    $("#kecamatan").selectpicker('refresh');
                }
            });
        });

        $("#kecamatan").change(function() {  
            var idkec = $(this).val();
            var idkab = $("#kabupaten").val();
            var token = $("meta[name='csrf-token']").attr("content");
            var url = "/shop/detail_ongkir";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: "html",
                data: {
                    "_token": token,
                    "idkab": idkab,
                    "idkec": idkec
                },
                success: function(msg) {
                    let tmp = JSON.parse(msg)
                    if (tmp.ongkir == '0') {
                        $('#ongkir').html('Gratis Ongkir!');
                    } else {
                        $('#ongkir').html('Rp. ' + tmp.ongkir);
                    }
                    $('#total').html('Rp.' + tmp.total);
                },
                error: function(data){
                    alert(data.message);
                }
            });
        })
    </script>
@endsection