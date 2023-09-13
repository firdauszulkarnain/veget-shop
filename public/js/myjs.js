$(document).ready(function() { 
    
     // Update Modal
     $('#tambahStock').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget)
        var modal = $(this)
        modal.find('#id_produk').attr("value", div.data('id_produk'));
      });

    var x = $('#mytabel').DataTable({
        "responsive" : true,
        "ordering": false,
        "lengthMenu": [
            [5, 10, 25, 40],
            [5, 10, 25, 40]
        ],
        "order": [[ 1, 'asc' ]],
    });
      x.on( 'order.dt search.dt', function () {
        x.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#mytabel tbody').on('click', '.tombol-hapus', function (e) {
        e.preventDefault();
        const form = $(this).closest('form');
        Swal.fire({
        title: 'Warning!',
        text: "Yakin Hapus Data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3498DB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Data!'
        }).then((result) => {
        if (result.isConfirmed) {
            // alert(form.submit());
            form.submit();
        }
        })
    });

    // Flashdata
    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
        Swal.fire({
        title: 'Success',
        text: 'Berhasil ' + flashData,
        icon: 'success'
        });
    }


    // Flashdata Update Status
    $('#mytabel tbody tr td').on('click', '.tombol-status', function (e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Warning!',
        text: "Yakin Konfirmasi Pembayaran?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3498DB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Konfirmasi'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });

    // Flashdata Selesai
    $('#mytabel tbody').on('click', '.tombol-kirim', function (e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Warning!',
        text: "Yakin Ubah Status Menjadi Pesanan Terikirim?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3498DB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Ubah Status'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });

      // Flashdata Selesai
      $('#mytabel tbody').on('click', '.tombol-selesai', function (e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Warning!',
        text: "Yakin Selesaikan Pesanan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3498DB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Selesai'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });

    $('.uang').mask('000.000.000.000', {
        reverse: true
      });

    var y = $('#tabel_produkBeli').DataTable({
        "responsive" : true,
        "lengthMenu": [
            [5, 10, 25, 50],
            [5, 10, 25, 50]
        ],
        "ordering": false,
        "order": [[ 1, 'asc' ]],
    });
      y.on( 'order.dt search.dt', function () {
        y.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $(".input-file").filestyle({
        'text' :'Choose File',
        'btnClass' :'btn-light border border-secondary px-4',
        'size' :'nr',
        'input' :true,
        'placeholder':'',
        'buttonBefore' :true,
    });

    $(".file-bayar").filestyle({
        'text' :'Choose File',
        'btnClass' :'st-color border border-secondary px-4',
        'size' :'nr',
        'input' :true,
        'placeholder':'',
        'buttonBefore' :true,
    });

    $('#mytabel tbody tr td').on('click', '.tombol-stock', function (e) {
        e.preventDefault();
        var stock = $(this).data('stock');
        if(stock == 1){
            var text = 'Tidak Tersedia';
        }else{
            var text = 'Tersedia';
        }
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Warning!',
        text: "Yakin Ubah Status Produk menjadi "+text+" ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3498DB',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Ubah Status'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    const datelocal =moment().format('Do MMMM YYYY');
    $('.date_trans').html(datelocal);

    $('#mytabel tbody').on('click', '.tombol-approve', function (e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Warning!',
        text: "Terima Pendaftaran Seller?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#218838',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Terima'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });

    $('#mytabel tbody').on('click', '.tombol-reject', function (e) {
        e.preventDefault();
        const form = $(this).parents('form');
        Swal.fire({
        title: 'Warning!',
        text: "Tolak Pendaftaran Seller?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#218838',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tolak'
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
        })
    });
});