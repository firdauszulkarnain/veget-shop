@extends('layouts.main')

@section('content')
<form action="{{ url('/produk/' . $produk->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row mb-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-light font-weight-bolder">
                    Deskripsi Sayuran
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_produk" class="text-dark">Nama Sayur</label>
                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                            id="nama_produk" name="nama_produk" autocomplete="off"
                            value="{{ old('nama_produk', $produk->nama_produk) }}" autofocus>
                        @error('nama_produk')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc_produk" class="tex">Deskripsi Sayur</label>
                        @error('desc_produk')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input id="desc_produk" type="hidden" name="desc_produk" value="{{ old('desc_produk', $produk->desc_produk) }}">
                        <trix-editor input="desc_produk" class="@error('description') border border-danger @enderror"></trix-editor>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary text-light font-weight-bolder">
                    Detail Sayuran
                </div>
                <div class="card-body">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitches" name="stock" checked>
                        <label class="custom-control-label text-primary font-weight-bolder" for="customSwitches" id="labelStock">
                            @if ($produk->stock_produk == 1)
                                Stock Tersedia                                
                            @else
                                Stock Tidak Tersedia
                            @endif
                        </label>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="harga_produk" class="text-dark">Harga Sayur</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary text-light font-weight-bolder px-3" id="basic-addon2">Rp</span>
                            </div>
                            <input type="text" class="form-control uang @error('harga_produk') is-invalid @enderror" id="harga_produk" name="harga_produk" autocomplete="off" value="{{ old('harga_produk', $produk->harga_produk) }}">
                        </div>
                        @error('harga_produk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="foto_produk" class="text-dark mt-3">Foto Sayur</label>
                            <input type="file" class="input-file" id="foto_produk" name="foto_produk" onchange="previewImage()" >
                            <h6 class="text-center font-weight-bolder mt-3">Preview Foto Sayur</h6>
                            <hr>
                            <img src="{{ asset('storage/' . $produk->foto_produk) }}" class="tengah img-preview img-fluid mb-3 tengah" style="max-width: 280px; max-height: 280px;">
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-style btn-block py-2 float-right mb-3 mt-3" type="submit">Simpan</button>
        </div>
    </div>
</form>



   <script>

    var check;
    $('#customSwitches').click(function() {
    if($(this).is(':checked')){
        $("#labelStock").attr('class', 'custom-control-label text-primary font-weight-bolder');
        $('#labelStock').html('Stock Tersedia');  
    } 
    else{
        $("#labelStock").attr('class', 'custom-control-label text-danger font-weight-bolder');
        $('#labelStock').html('Stock Tidak Tersedia');
    }
    });

      $('trix-editor').css("min-height", "200px");
      document.addEventListener('trix-file-accept', function(e) {
         e.preventDefault();
      })

      
      function previewImage() {
      const image = document.querySelector('#foto_produk');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0])

      oFReader.onload = function(oFREvent) {
         imgPreview.src = oFREvent.target.result;
      }
   }
    </script>
@endsection

