<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request Reset Password Mai Sayur</title>

    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <style>
        body{
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body style="background-color: #0B3005">
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header font-weight-bolder text-center">{{ __('Request Reset Password Mai Sayur') }}</div>
    
                    <div class="card-body px-4 pb-3">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                               Kami Sudah Kirim Link Reset Password ke Email Anda!
                            </div>
                        @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3 d-flex justify-content-center">
                          <div class="col-lg-11">
                            <img src="/dist/img/logo6.png" width="80%" class="tengah shadow-sm p-3 mb-2 bg-white rounded" alt="">
                            <input id="email" type="email" class="form-control mt-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email Address">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <button type="submit" class="btn btn-style d-flex justify-content-center">
                                {{ __('KIRIM RESET PASSWORD') }}
                            </button>
                        </div>
                        <p class="text-center mt-3">Kembali ke <a href="{{ route('login') }}" class="text-decoration-none text-dark"><b>Login</b></a></p>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/adminlte.min.js') }}"></script>
</body>
</html>
