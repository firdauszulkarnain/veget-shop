<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Mai Sayur</title>

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
        <div class="row mt-5 d-flex justify-content-center">
            <div class="login-box mt-5">
                <div class="card">
                    <div class="pt-5 pb-3 px-4">
                        <div class=" card-body p-0">
                            <div class="text-center">
                                <h2 style="font-size: 40px; color: #0B3005"><i class="fa-solid fa-user"></i> MASUK</h2>
                                <hr class="garis mb-4">
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="mt-0">
                                @csrf
                                <div class="mb-3">
                                    <div class="input-group @error('username') is-invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text st-color">
                                                <span class="fas fa-fw fa-user"></span>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Username" name="username"
                                            autocomplete="off" autofocus>
                                    </div>
                                    @error('username')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div>
                                    <div class="input-group @error('password') is-invalid @enderror">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text st-color">
                                                <span class="fas fa-fw fa-lock"></span>
                                            </span>
                                        </div>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" name="password" autocomplete="off">
                                    </div>
                                    @error('password')
                                        <div class=" invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="mb-4 float-right"><a href="{{ route('password.request') }}" class="text-decoration-none text-dark font-weight-bolder">Lupa Password?</a></small>
                                <button class="btn st-color btn-block font-weight-bolder" type="submit">MASUK</button>
                                <hr>
                                <div class="text-center mt-4">
                                    <p class="small">Belum Punya Akun? Silahkan
                                        <a href="{{ route('register') }}"
                                            class="text-decoration-none" style="color: #0B3005">
                                            <strong> REGISTRASI</strong>
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @if (Session::has('error'))
        <script>
            var message = '{{ Session::get('error') }}';
            Swal.fire({
                title: 'Error!',
                text:  message,
                icon: 'error'
            });
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            var message = '{{ Session::get('success') }}';
            Swal.fire({
                title: 'Berhasil',
                text:  message,
                icon: 'success'
            });
        </script>
    @endif
</body>

</html>
