<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        #main {
            width: 100%;
            font-family: arial, sans-serif;
            font-size: 13px;
        }
        #main td {
            text-align: left;
            padding: 5px 8px 5px 8px;
            border: 1px solid black;
        }
        #main {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table id="main">
        <tr>
            <td colspan="2" style="background-color: #acacac; align:center;">
                <p style="color: #0b3005;"><b>MAI SAYUR</b></p>
                {{-- <img src="{{  public_path() }}/dist/img/logo6.png" alt=""> --}}
                <h4 id="no_pesanan" style="margin-top: -15px; font-size: 20px; align:center;">{{ $pesanan->no_pesanan }}</h4>
                <p  style="margin-top: -27px;">Tgl Pesanan: {{ date("d-m-Y", strtotime($pesanan->tgl_pesan)) }}</p>
            </td>
        </tr>
        <tr>
            <td width='30%'>
                <b>Pembayaran</b>
            </td>
            <td>
                <span id="nama_penerima" ><b>
                @if ($pesanan->tipe_pembayaran == 0)
                    Bank Transfer
                @else
                    COD (<i>Cash On Delivery</i>)
                @endif</b></span>
            </td>
        </tr>
        <tr>
            <td width='30%'>
                <b>Nama</b>
            </td>
            <td>
                <span id="nama_penerima">{{ $pesanan->pengiriman->nama_penerima }}</span>
            </td>
        </tr>
        <tr>
            <td width='30%'>
                <b>No Telp</b>
            </td>
            <td>
                <span id="notelp_penerima">{{ $pesanan->pengiriman->notelp_penerima }}</span>
            </td>
        </tr>
        <tr>
            <td width='30%'>
                <b>Alamat</b>
            </td>
            <td>
                <span id="alamat_penerima">{{ $pesanan->pengiriman->alamat_penerima . ', Kec. ' . ucwords(strtolower($pesanan->pengiriman->kecamatan->nama_kec)) . ', Kab. ' . ucwords(strtolower($pesanan->pengiriman->kabupaten->nama_kab)) }}</span>
            </td>
        </tr>
    </table>
    <table id="main">
        <tr>
            <td colspan="3" style="align:center;"><b>Detail Pesanan</b></td>
        </tr>
        <tr>
            <td style="text-align: center;">No.</td>
            <td style="text-align: center;">Nama Sayuran</td>
            <td style="text-align: center;">Qty</td>
        </tr>
        @foreach ($detail as $item) 
        <tr>
            <td width='5%' style="text-align: center;">{{ $loop->iteration }}</td>
            <td width='60%' style="text-align: center; text-transform: capitalize;">{{ $item->produk->nama_produk  }}</td>
            <td width='35%' style="text-align: center;">{{ $item->qty }} (*100 gram)</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2" style="text-align: center;">
             <b style="text-align: center;">Total</b>
            </td>
            <td style="text-align: center;"> <b id="total"  style="text-align: center;">Rp. {{number_format($pesanan->total, 0, ',', '.')}}</b></td>
         </tr>
    </table>
</body>
</html>