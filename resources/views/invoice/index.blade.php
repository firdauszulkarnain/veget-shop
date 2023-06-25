@extends('layouts.main')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Data Invoice</h1>
    <form action="{{ (auth()->user()->role == 1) ? route('admin.laporan.pdf') : route('seller.laporan.pdf')}}" method="POST">
        @csrf
        <button class="btn btn-style float-right" type="submit">Download PDF</button>
    </form>
</div>

<div class="row mb-5">
    <div class="col-lg-12">
        <div class="card border-top-primary">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="mytabel" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Nomor Invoice</th>
                            <th scope="col">Customer Email</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tgl. Invoice</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice as $row)
                            <tr class="text-center">
                                <td></td>
                                <td>{{ $row->no_invoice }}</td>
                                <td>{{ $row->user->email }}</td>
                                <td>Rp. {{ number_format($row->total, 0, ',', '.') }}</td>
                                <td>{{ date("d-m-Y", strtotime($row->tgl_invoice)) }}</td>
                                <td>
                                    @if (auth()->user()->role == 1)
                                        <a href="{{ route('admin.detinv', $row->no_invoice) }}"
                                        class="btn btn-primary btn-sm"><i class="fas fa-fw fa-search"></i></a>
                                    @else
                                        <a href="{{ route('seller.detinv', $row->no_invoice)}}"
                                        class="btn btn-primary btn-sm"><i class="fas fa-fw fa-search"></i></a>
                                    @endif
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
