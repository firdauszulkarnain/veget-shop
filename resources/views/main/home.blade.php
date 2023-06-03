@extends('layouts.shop')

@section('content')
        <!-- Hero Section Begin -->
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero__item set-bg" data-setbg="{{ asset('/template/img/hero/banner.jpg') }}">
                            <div class="hero__text">
                                <h2>SAYURAN <br />100% FRESH</h2>
                                <p>Tersedia Pengiriman Berbagai Wilayah Bali</p>
                                <a href="#" class="primary-btn px-5">SHOP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
    
        <!-- Featured Section Begin -->
        <section class="featured spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Sayuran Mai Sayur</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($produk as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg shadow-sm p-3 mb-5 bg-white rounded" data-setbg="{{ asset('storage/'. $item->foto_produk) }}">
                                    <ul class="featured__item__pic__hover">
                                        @if (!auth()->check())
                                            <li><a href="{{ route('login') }}"><i class="fa fa-shopping-cart"></i></a></li>
                                        @else  
                                            <li>
                                                <a href="javascript:;" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modalKeranjang" class="modal_keranjang">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6 class="text-capitalize"><a href="{{ url('/shop/detail-produk/'. $item->id) }}">{{ $item->nama_produk }}</a></h6>
                                    <h5>Rp.{{ number_format($item->harga_produk2, 0, ',', '.') }} - Rp.{{ number_format($item->harga_produk1, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <div class="modal fade" id="modalKeranjang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Ringkas Produk</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-6">
                        <img src="" alt="" id="foto_produk" width="100%" cla>
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="POST" id="tambah_produk">
                            @csrf
                            <div class="product__details__text mt-3">
                                <h3 class="text-capitalize" id="nama_produk">Nama Produk</h3>
                                <div class="product__details__price" style="font-size: 20px !important;" id="harga_produk"></div>
                                <p class="text-justify pr-5" id="desc_produk"></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipe_produk" id="harga1" value="1" checked>
                                    <label class="form-check-label" for="harga1" id="label_harga1"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipe_produk" id="harga2" value="2">
                                    <label class="form-check-label" for="harga2" id="label_harga2"></label>
                                </div>
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty" id="pro-qty">
                                            <input type="text" value="1" name="qty" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="keranjang" class="primary-btn border-0"><i class="fa fa-shopping-cart"></i></button>
                                <ul class="mt-n3">
                                    <li><b>Stock</b> <span>Tersedia</span></li>
                                    <li><b>Store</b> <span class="text-capitalize" id="toko"></span></li>
                                </ul>
                            </div>
                        </form>
                        
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        <!-- Featured Section End -->
        <script>
            $(document).on("click", "#keranjang", function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                var urlForm = $(this).parents('form').attr('action');
                // var idProduk = urlForm.split(",");
                var idProduk = urlForm.split("/");
                idProduk = idProduk[3];
                var url = "/shop/cek_produk";
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type: "post",
                    url: url,
                    dataType: "html",
                    data: {
                        "_token": token,
                        "idProduk" : idProduk
                    },
                    success: function(msg) {
                        let tmp = JSON.parse(msg);
                        // alert(tmp.change);
                        if(tmp.change == 1){
                            Swal.fire({
                                title: 'Warning!',
                                text: "Anda memiliki item dari toko lain dalam keranjang, ganti item dari toko ini?",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#539165',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Pesan Item Ini!'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            })
                        }else{
                            form.submit();
                        }
                    },error: function(){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Kesalahan Akun Privilege',
                            icon: 'error'
                        });
                    }
                });
            });
    
            $(document).on("click", ".modal_keranjang", function() {
                var idProduk = $(this).data('id');
                var url = "/shop/modal/"+idProduk;
                var urlDetail = "/shop/detail-produk/"+idProduk;
                var urlTambah ="/shop/tambah_keranjang/"+idProduk;
                var gambar = 'storage/';
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "html",
                    success: function(msg) {
                        let tmp = JSON.parse(msg);
                        $(".modal-body #nama_produk").html(tmp.nama_produk);
                        $(".modal-body #desc_produk").html(tmp.desc_produk);
                        $(".modal-body #harga_produk").html(tmp.harga_produk);
                        $(".modal-body #label_harga1").html(tmp.harga_produk1);
                        $(".modal-body #label_harga2").html(tmp.harga_produk2);
                        $(".modal-body #toko").html(tmp.toko);
                        $(".modal-body #foto_produk").attr("src", tmp.foto_produk);
                        $(".modal-body .see-more").attr("href", urlDetail);
                        $(".modal-body #tambah_produk").attr("action", urlTambah);
                        
                    },error: function(){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error Get Data Produk',
                            icon: 'error'
                        });
                    }
                });
            });
        </script>

        @endsection