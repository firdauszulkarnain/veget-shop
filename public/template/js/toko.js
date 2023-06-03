$(document).ready(function() { 
    toastr.options = {
        "positionClass": "toast-bottom-right"
    }

    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
        toastr.success(flashData);
    }

    const error= $('.error').data('error');
    if (error) {
        toastr.error(error);
    }

    $('#mytabel').DataTable({
        responsive: true,
        "ordering": false,
        "lengthChange" : false,
        "lengthMenu": [
            [5],
            [5]
        ],
        "searching" : false
    });

    $(".input-file").filestyle({
        'text' :'Choose File',
        'btnClass' :'btn-light border border-secondary px-5',
        'size' :'nr',
        'input' :true,
        'placeholder':'',
        'buttonBefore' :true,
    });

     // Tombol Konfirmasi Pembayaran
     $('.tombol-bayar').on('click', function(e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Konfirmasi',
        text: "Yakin Lanjutkan Proses Ke Pembayaran?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#7fad39',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Lanjutkan!'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });

    // Tombol Konfirmasi Hapus Pesanan
    $('.hapus-pesanan').on('click', function(e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Konfirmasi',
        text: "Yakin Batalkan Pesanan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7fad39',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });

    // Tombol Konfirmasi Hapus Pesanan
    $('.tombol-terima').on('click', function(e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Konfirmasi',
        text: "Konfirmasi Pesanan Sudah Diterima?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7fad39',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Konfirmasi'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });
});