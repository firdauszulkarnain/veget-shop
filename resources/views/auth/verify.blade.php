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

<body style="background-color: #1D4E56">
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header font-weight-bolder ">{{ __('Verify Your Email Address') }}</div>
    
                    <div class="card-body px-4 pb-5">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
    
                        <img src="/shop-template/img/logo2.png" width="80%" class="tengah shadow-sm p-3 mb-2 bg-white rounded" alt="">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        {{ __('click button below to request another') }}
                        <form class="d-flex justify-content-center mt-3" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-md sd-color align-baseline px-3 py-2  shadow-sm rounded">Resend Email Verification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/dist/js/adminlte.js') }}"></script>
</body>
</html>
