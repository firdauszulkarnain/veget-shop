@extends('layouts.main')


@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-3">
  <h1 class="h3 mb-0 text-gray-800">Master Data Sayuran</h1>
  <a href="/produk/create" class="btn btn-style float-right"><i class="fas fa-fw fa-plus"></i> Tambah Data Sayur</a>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card border-top-primary">
       <div class="card-body">
           <table class="table table-striped table-bordered" id="mytabel" width="100%">
               <thead>
                   <tr class="text-center">
                       <th scope="col">No.</th>
                       <th scope="col">Sayuran</th>
                       <th scope="col">Harga</th>
                       <th scope="col">Stock</th>
                       <th scope="col">Action</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($produk as $row)
                       <tr class="text-center">
                           <td></td>
                           <td class="text-capitalize">{{ $row->nama_produk }}</td>
                           <td>Rp. {{ number_format($row->harga_produk, 0, ',', '.') }}</td>
                           <td>
                            @if ($row->stock_produk == 1)
                                <span class="badge badge-primary">Tersedia</span>
                             @else
                                <span class="badge badge-danger">Tidak Tersedia</span>
                            @endif
                           </td>
                           <td>
                               <form action="{{ route('update_stock', $row->id) }}" method="POST" class="d-inline">
                                   @csrf
                                   @if ($row->stock_produk == 1)
                                     <button class="btn btn-dark btn-sm tombol-stock" data-stock="{{ $row->stock_produk }}"><i class="fas fa-fw fa-arrow-circle-down"></i></button>
                                   @else
                                     <button class="btn btn-success btn-sm tombol-stock" data-stock="{{ $row->stock_produk }}"><i class="fas fa-fw fa-arrow-circle-up"></i></button>
                                   @endif
                               </form>
                               <a href="{{ url('produk/' . $row->id) }}/edit"
                                   class="btn btn-primary btn-sm"><i class="far fa-fw fa-edit"></i></a>
                               <form action="{{ url('produk/' . $row->id) }}" method="POST" class="d-inline tombol-hapus">
                                   @method('delete')
                                   @csrf
                                   <button class="btn btn-danger btn-sm">
                                       <i class="far fa-fw fa-trash-alt"></i>
                                   </button>
                               </form>
                           </td>
                       </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
    </div>
   </div>
</div>
@endsection