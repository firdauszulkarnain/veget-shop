@extends('layouts.main')

@section('content')
<div class="row d-flex justify-content-center mb-5">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header font-card-header bg-primary text-light font-weight-bolder">
                Store Detail
            </div>
            <div class="card-body">
               <div class="row">
                    <div class="col-lg-4">
                        <img src="/dist/img/logo2.png" class="img-circle tengah ml-4 mt-4" alt="User Image" width="100%">
                    </div>
                    <div class="col-lg-8 px-5">
                        <form action="{{ route('seller.profile') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_toko">Nama Toko</label>
                                <input type="text" class="form-control bg-light @error('nama_toko') border border-danger @enderror" id="nama_toko" name="nama_toko" value="{{ $store->nama_toko }}" autocomplete="off">
                                @error('nama_toko')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="notelp_toko">No. Telp Toko</label>
                                <input type="text" class="form-control bg-light @error('notelp_toko') border border-danger @enderror" id="notelp_toko" name="notelp_toko" value="{{ $store->notelp_toko }}" autocomplete="off">
                                @error('notelp_toko')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="alamat_toko">Alamat Toko</label>
                                <textarea class="form-control bg-light @error('alamat_toko') border border-danger @enderror" id="alamat_toko" rows="2" name="alamat_toko" autocomplete="off">{{ $store->alamat_toko }}</textarea>
                                @error('alamat_toko')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-style mb-2 px-4 float-right" type="submit">Simpan</button>
                        </form>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
