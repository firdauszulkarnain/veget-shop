<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification Email</title>
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
                    <div class="card-header font-weight-bolder ">{{ __('VERIFIKASI EMAIL AKUN MAISAYUR') }}</div>
    
                    <div class="card-body px-4 pb-5">
                        {{-- @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Link baru untuk verifikasi email sudah dikirim ke email anda') }}
                            </div>
                        @endif --}}
    
                        <img src="/dist/img/logo6.png" width="80%" class="tengah shadow-sm p-3 mb-2 bg-white rounded" alt="">
                        {{ __('Silahkan cek email anda untuk verifikasi akun.') }}
                        {{ __('Jika anda belum mendapatkan email,') }}
                        {{ __('click tombol di bawah untuk request email lain') }}
                        <form class="d-flex justify-content-center mt-3" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-style align-baseline px-3 py-2  shadow-sm rounded">Kirim Ulang Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @if (session('resent'))
        <script>
            Swal.fire({
                text:  'Link Verifikasi akun sudah dikirimkan ulang ke email anda!',
                icon: 'success'
            });
        </script>
    @endif
</body>
</html>
