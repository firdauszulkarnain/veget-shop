@extends('layouts.main')


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Master Data Ongkir</h1>
        <button type="button" class="btn btn-style float-right" data-toggle="modal" data-target="#tambahOngkir">
            <i class="fas fa-fw fa-plus"></i> Tambah Data Ongkir
        </button>
    </div>

    <!-- Main content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-top-primary">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="mytabel" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Harga Ongkir</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ongkir as $row)
                            <tr class="text-center">
                                <td></td>
                                <td class="text-capitalize">{{ $row->kabupaten->nama_kab }}</td>
                                <td class="text-capitalize">{{ $row->kecamatan->nama_kec }}</td>
                                <td>Rp. {{ number_format($row->harga_ongkir, 0, ',', '.') }}</td>
                                <td>
                                    <a href="#" data-id="{{ $row->id }}" data-toggle="modal" data-target="#updateOngkir" class="btn btn-sm btn-primary text-light modal_update"><i class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ url('ongkir/' . $row->id) }}" method="POST"
                                        class="d-inline tombol-hapus">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            <i class="far fa-fw fa-trash-alt"></i>
                                    </form>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
      

  <div class="modal fade" id="tambahOngkir" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Ongkir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/ongkir" method="POST">
            <div class="modal-body">
                @csrf
                <div class="form-group mb-4">
                    <label for="kabupaten">Kabupaten</label>
                    <select class="form-control selectpicker border" id="kabupaten" name="kabupaten" data-size="4" data-live-search="true" title="Pilih Kabupaten" required>
                        @foreach ($kabupaten as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kab }}</option>
                        @endforeach 
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="kecamatan">Kecamatan</label>
                    <select class="form-control selectpicker border" id="kecamatan" name="kecamatan" title="Pilih Kecamatan" data-size="4" data-live-search="true" required>
                        <option value=""></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga_ongkir">Harga Ongkir</label>
                    <input type="text" class="form-control uang" id="harga_ongkir " name="harga_ongkir" value="{{ old('harga_ongkir') }}" autocomplete="off" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-style btn-sm btn px-4 py-2">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Ongkir Modal -->
<div class="modal fade mt-5" id="updateOngkir" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Harga Ongkir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formUpdate">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kabupaten">Kabupaten</label>
                        <input type="text" class="form-control" id="up_kab" name="kabupaten" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" class="form-control" id="up_kec" name="kecamatan" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="harga_ongkir">Harga</label>
                        <input type="text" class="form-control uang" id="up_ongkir" name="harga_ongkir" value="" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-style btn-sm btn px-4 py-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
  <script>
    $("#kabupaten").change(function() {
       var id_kab = $(this).val();
       var url = "/get_kecamatan";
       var csrf = $("meta[name='csrf-token']").attr("content");
       $.ajax({
           type: "post",
           url: url,
           data: {
               "_token": csrf,
               "id_kab" : id_kab
           },
           success: function(msg) {
               $("#kecamatan").html(msg).selectpicker('refresh');
               $("#kecamatan").selectpicker('refresh');
           }
       });
   });

   $(document).on("click", ".modal_update", function() {
        var idOngkir = $(this).data('id');
        var url = "ongkir/"+idOngkir;
        $.ajax({
            type: "get",
            dataType: "html",
            url: url,
            success: function(msg) {
                let tmp = JSON.parse(msg);
                $("#formUpdate").attr('action', '/ongkir/'+idOngkir);
                $(".modal-body #id").val(idOngkir);
                $(".modal-body #up_kab").val(tmp.kabupaten);
                $(".modal-body #up_kec").val(tmp.kecamatan);
                $(".modal-body #up_ongkir").val(tmp.harga_ongkir);
            }
        });
    });

</script>
@endsection
