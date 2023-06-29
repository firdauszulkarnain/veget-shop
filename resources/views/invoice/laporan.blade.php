<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: sans-serif;
        }
        #main {
            width: 100%;
            font-family: sans-serif;
            font-size: 13px;
        }
        #main tr th{
            background: #0b3005;
            color: #fff;
            font-weight: normal;
            padding: 10px 8px 10px 8px;
            border: 1px solid black;
            text-align: center;
        }
        #main td {
            text-align: left;
            padding: 10px 8px 10px 8px;
            border: 1px solid black;
            text-align: center;
        }
        #main {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <p style="text-align: center; color: #0b3005;"><b>Mai-Sayur</b></p>
    <h2 style="text-align: center; margin-top: -15px;">Laporan Penjualan</h2>
    @if (auth()->user()->role == 2)
    <p style="text-align: center; margin-top: -15px; font-size: 12px;">Toko: <b>{{ $store->nama_toko }}</b></p>
    @endif
    <table id="main" width="100%">
		<tr>
                <th width="5%">No.</th>
                <th width="20%">No. Invoice</th>
                <th width="15%">Tgl. Invoice</th>
                <th width="25%">Metode Pembayaran</th>
                @if (auth()->user()->role == 1)
                    <th width="15%">Toko</th>
                @endif
                <th width="20%">Total</th>
		</tr>
        @foreach ($invoice as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->pesanan->no_pesanan }}</td>
            <td>{{ date("d-m-Y", strtotime($item->tgl_invoice)) }}</td>
            @if ($item->pesanan->tipe_pembayaran == 0)
                <td>Bank Transfer</td>
            @else
                <td>COD (<i>Cash On Delivery</i>)</td>
            @endif
            @if (auth()->user()->role == 1)
                <td>{{ $item->pesanan->store->nama_toko }}</td>
            @endif
            <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
            
        </tr>
    @endforeach

    <tr>
        @if (auth()->user()->role == 1)
        <td colspan="5" style="text-align: center;"><b>Total</b></td>
        @else
        <td colspan="4" style="text-align: center;"><b>Total</b></td>
        @endif
        <td><b>Rp. {{ number_format($total, 0, ',', '.') }}</b></td>
    </tr>
       
	</table>	
</body>
</html>