@extends('layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Master Data Seller</h1>
</div>

<div class="row mb-5">
    <div class="col-lg-12">
        <div class="card border-top-primary">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="mytabel" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Nama Toko</th>
                            <th scope="col">Username</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seller as $row)
                            <tr class="text-center">
                                <td></td>
                                <td class="text-capitalize">{{ $row->nama_toko }}</td>
                                <td>{{ $row->user->username }}</td>                                          
                                <td>{{ $row->notelp_toko }}</td>                                          
                                <td>{{ $row->user->email }}</td> 
                                <td>
                                    <form action="{{ route('delete_user', $row->user->id) }}" method="POST" class="d-inline" >
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm tombol-hapus" type="submit">
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
