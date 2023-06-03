@extends('layouts.main')

@section('content')
<div class="row d-flex justify-content-center mb-5">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header font-weight-bolder bg-primary text-light">Tambah Data Administrator</div>
            <div class="card-body px-4 pb-3">
                <form action="{{ route('tambah_admin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            id="username" name="username" autocomplete="off"
                            value="{{ old('username') }}" autofocus>
                        @error('username')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" autocomplete="off"
                            value="{{ old('email') }}" autofocus>
                        @error('email')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="notelp">No. Telp</label>
                        <input type="text" class="form-control @error('notelp') is-invalid @enderror"
                            id="notelp" name="notelp" autocomplete="off"
                            value="{{ old('notelp') }}" autofocus>
                        @error('notelp')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" autocomplete="off"
                            value="{{ old('password') }}" autofocus>
                        @error('password')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-style float-right font-weight-bolder px-4 mb-4" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
