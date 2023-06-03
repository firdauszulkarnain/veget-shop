<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Mai Sayur">
    <meta name="author" content="MangDharma">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | MAI SAYUR</title>

    <link href="/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script>moment.locale('id');</script>
    <link rel="stylesheet" href="{{ asset('/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('/sb-admin/css/sb-admin-2.css') }}">

    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/trix.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

</head>

<body id="page-top">

    <div id="wrapper">

        @include('partials.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('partials.navbar')
                <div class="container-fluid">
                   @yield('content')
                </div>
            </div>


            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Mai Sayur {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>

    </div>
   
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/logout" method="POST">
                       @csrf
                       <button class="btn btn-danger" type="submit">Logout</button>
                    </form>
                 </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('/sb-admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('/js/select/defaults-id_ID.js') }}"></script>
    <script src="{{ asset('/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-mask/jquery.mask.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"> </script>
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('/js/myjs.js') }}"></script>
    @if (Session::has('success'))
        <script>
            var message = '{{ Session::get('success') }}';
            Swal.fire({
                title: 'Success',
                text:  message,
                icon: 'success'
            });
        </script>   
    @endif

    @if (Session::has('error'))
    <script>
        var message = '{{ Session::get('error') }}';
        Swal.fire({
            title: 'Error',
            text:  message,
            icon: 'error'
        });
    </script>   
@endif

</body>

</html>