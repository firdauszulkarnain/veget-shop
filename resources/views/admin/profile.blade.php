@extends('layouts.main')

@section('content')
<div class="row d-flex justify-content-center mb-5">
    <div class="col-lg-10">
        <div class="card-header font-card-header bg-primary text-light font-weight-bolder">
            Profile Administrator
        </div>
        <div class="card">
            <div class="card-body">
               <div class="row">
                    <div class="col-lg-4">
                        <img src="/dist/img/logo2.png" class="img-circle tengah ml-4 mt-5" alt="User Image" width="100%">
                    </div>
                    <div class="col-lg-8 px-5">
                        <form action="{{ route('admin.profile') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') border border-danger @enderror" id="password" name="password" autocomplete="off">
                                @error('password')
                                  <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password2">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password2') border border-danger @enderror" id="password2" name="password2" autocomplete="off">
                                @error('password2')
                                  <small class="text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-style mb-2 float-right" type="submit">Simpan Password</button>
                        </form>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
