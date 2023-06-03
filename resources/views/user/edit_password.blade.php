@extends('layouts.shop')

@section('content')
    <section class="breadcrumb-section st-color container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Ganti Password</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container ">
        <div class="row mb-5 mt-5 d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card px-3 py-3" style="background-color: #0B3005">
                            <div class="card-body">
                                <img src="/dist/img/logo2.png" alt="" width="70%" class="tengah mb-4">
                                <form action="{{ route('update_password') }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <label for="password" class="text-light">Password</label>
                                        <input type="password" class="form-control @error('password') border border-danger @enderror" id="password" name="password" autocomplete="off">
                                        @error('password')
                                        <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password2" class="text-light">Konfirmasi Password</label>
                                        <input type="password" class="form-control @error('password2') border border-danger @enderror" id="password2" name="password2" autocomplete="off">
                                        @error('password2')
                                        <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <a href="{{ route('profile') }}" class="btn btn-danger mt-3 mb-3 px-4">Kembali</a>
                                    <button class="btn btn-light mt-3 mb-3 px-4 float-right">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="section-title related-blog-title">
                            <h2>FaQ</h2>
                            <div class="py-3">
                              
                                <div class="accordion mt-4" id="faqExample">
                                    <div class="card">
                                        <div class="card-header p-2 st-color" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link text-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Q: Apa itu Mai Sayur?
                                                </button>
                                                </h5>
                                        </div>
                    
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqExample">
                                            <div class="card-body">
                                                <b>Answer:</b> MaiSayur adalah toko online yang dapat digunakan untuk memesan sayuran melalui aplikasi berbasis website
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-header p-2 st-color" id="headingTwo">
                                            <h5 class="mb-0">
                                            <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Q: Bagaimana Cara memesan sayur di Mai Sayur?
                                            </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                                            <div class="card-body text-left">
                                            <b>Answer:</b> <br>
                                              1. Customer dapat memilih sayuran yang diinginkan <br>
                                              2. Customer dapat melakukan konfirmasi pemesanan dan pembayaran <br>
                                              3. Customer dapat menunggu sampai sayuran diterima <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-header p-2 st-color" id="headingThree">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Q. Bagaimana sayuran kami dapat diterima?
                                                </button>
                                                </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                                            <div class="card-body">
                                            <b>Answer:</b> Mai Sayur menyediakan jasa pengiriman sesuai dengan harga dari masing-masing penjual sayur yang sudah ditentukan sesuai lokasi customer
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-header p-2 st-color" id="headingFour">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    Q. Jam Buka Pesanan MaiSayur?
                                                </button>
                                                </h5>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqExample">
                                            <div class="card-body">
                                                <b>Answer:</b>  Mai Sayur dapat menerima pesana 24 jam, namun akan dikonfirmasi oleh admin dan penjual dari pukul 10.00 AM - 09.00 PM
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--container-->
                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection