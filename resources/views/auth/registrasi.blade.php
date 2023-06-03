<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRASI VEGET SHOP</title>

    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet">
    <style>
        body{
            font-family: 'Kanit', sans-serif !important;
        }
    </style>
</head>

<body style="background-color: #0B3005">
    <div class="container mb-5">
        <div class="row mt-5 d-flex justify-content-center conta">
            <div class="col-lg-4">
                <!-- <div class="login-box mt-5"> -->
                <div class="card">
                    <div class="px-4 py-5">
                        <div class=" card-body p-0">
                            <h2 style="font-size: 30px; color: #0B3005" class="text-center"><i class="fa-solid fa-user"></i> REGISTRASI</h2>
                            <hr class="garis">
                            <form action="{{ route('register') }}" method="POST" class="mt-3">
                                @csrf
                                <div class="mb-3">
                                    <div class="input-group @error('username') is-invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-light st-color" >
                                                <span class="fas fa-fw fa-user"></span>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Username" value="{{ old('username') }}" name="username"
                                            autocomplete="off" autofocus>
                                    </div>
                                    @error('username')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="input-group @error('email') is-invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-light st-color">
                                                <span class="fas fa-fw fa-at"></span>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="input-group @error('notelp') is-invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-light st-color">
                                                <span class="fas fa-fw fa-phone"></span>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control @error('notelp') is-invalid @enderror"
                                        id="notelp" name="notelp" autocomplete="off" value="{{ old('notelp') }}" placeholder="No. Telp">
                                    </div>
                                    @error('notelp')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="input-group @error('password') is-invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-light st-color">
                                                <span class="fas fa-fw fa-lock"></span>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="off">
                                    </div>
                                    @error('password')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button class="btn st-color btn-block mb-3" type="submit">REGISTRASI</button>
                            </form>
                            <div class="text-center">
                                <p class="small text-dark">Sudah Punya Akun? Silahkan
                                    <a href="{{ url('/login') }}" class="text-decoration-none" style="color: #0B3005">
                                        <strong>LOGIN</strong>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>

            </div>
        </div>



        <script src="/plugins/jquery/jquery.min.js"></script>
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/dist/js/adminlte.js"></script>
</body>

</html>
