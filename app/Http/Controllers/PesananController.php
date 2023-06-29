<?php

namespace App\Http\Controllers;

use App\Models\Detpesanan;
use App\Models\Pengiriman;
use App\Models\Store;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PesananController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 1) {
            $pesanan = Pesanan::with(['user', 'store'])->whereNotIn('status', [0, 5])->get();
        } else if (auth()->user()->role == 2) {
            $store = Store::where('user_id', auth()->user()->id)->first();
            $pesanan = Pesanan::with(['user', 'store'])->whereNotIn('status', [0, 5])->where('store_id', $store->id)->get();
        }
        $data = [
            'title' => 'Data Pesanan',
            'pesanan' => $pesanan,
        ];

        return view('pesanan.index', $data);
    }

    public function konfirmasi()
    {
        $pesanan = Pesanan::with(['user', 'store'])->where('status', 2)->get();
        $data = [
            'title' => 'Data Konfirmasi Pesanan',
            'pesanan' => $pesanan,
        ];

        return view('pesanan.konfirmasi', $data);
    }

    public function konfirmasi_bayar(Pesanan $pesanan)
    {
        $pesanan->status = 3;
        $pesanan->save();
        return redirect()->route('admin.pesanan')->with('success', 'Berhasil Konfirmasi Pembayaran Invoice ' . $pesanan->no_pesanan);
    }

    public function konfirmasi_seller()
    {
        $store = Store::where('user_id', auth()->user()->id)->first();
        $pesanan = Pesanan::with(['user', 'store'])->where('store_id', $store->id)->where(['status' => 4, 'bukti_bayar' => null])->get();
        $data = [
            'title' => 'Data Kirim Pesanan',
            'pesanan' => $pesanan,
        ];

        return view('pesanan.konfirmasi_seller', $data);
    }

    public function proses_konfirmasi(Request $request, Pesanan $pesanan)
    {
        $post = $request->validate([
            'bukti_bayar' => 'image|file|max:2048',
            'tgl_bayar' => 'required',
        ]);

        if ($request->file('bukti_bayar')) {
            $post['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti_pembayaran');
        }

        $pesanan->bukti_bayar = $post['bukti_bayar'];
        $pesanan->tgl_bayar = date("Y-m-d",  strtotime($post['tgl_bayar']));
        $pesanan->save();

        return redirect()->route('seller.konfirmasi')->with('success', 'Berhasil Konfirmasi Pesanan');
    }


    public function kirim()
    {
        $store = Store::where('user_id', auth()->user()->id)->first();
        $pesanan = Pesanan::with(['user', 'store', 'pengiriman'])->where('store_id', $store->id)->where('status', 3)->get();
        $data = [
            'title' => 'Data Kirim Pesanan',
            'pesanan' => $pesanan,
        ];

        return view('pesanan.kirim_pesanan', $data);
    }

    public function kirim_pesanan(Pesanan $pesanan)
    {
        $pesanan->status = 4;
        $pesanan->save();
        return redirect()->route('seller.pesanan')->with('success', 'Berhasil Ubah Status Kirim Pesanan Invoice ' . $pesanan->no_pesanan);
    }

    public function detail(Pesanan $pesanan)
    {
        $pesanan = Pesanan::with(['user', 'pengiriman'])->where('no_pesanan', $pesanan->no_pesanan)->first();
        $data = [
            'title' => 'Detail Pesanan',
            'pesanan' => $pesanan,
            'detail' => Detpesanan::with(['produk'])->where('pesanan_id', $pesanan->id)->get()
        ];

        return view('pesanan.detail_pesanan', $data);
    }

    public function pesanan_invoice(Pesanan $pesanan)
    {

        $pesanan = Pesanan::with(['user', 'pengiriman'])->where('id', $pesanan->id)->first();
        $detPesanan =  Detpesanan::with(['produk'])->where('pesanan_id', $pesanan->id)->get();
        $kecamatan = ucwords(strtolower($pesanan->pengiriman->kecamatan->nama_kec));
        $kabupaten = ucwords(strtolower($pesanan->pengiriman->kabupaten->nama_kab));
        $alamat = $pesanan->pengiriman->alamat_penerima . ', Kec. ' . $kecamatan . ', Kab. ' . $kabupaten;
        $nama = $pesanan->pengiriman->nama_penerima;
        $notelp = $pesanan->pengiriman->notelp_penerima;

        $detail = '';
        $no = 1;

        foreach ($detPesanan as $item) {
            $detail .= '<tr id="sayur"><td>' . $no . '</td><td width="60%" class="text-capitalize">' . $item->produk->nama_produk . '</td><td>' . $item->qty . ' (*100) gram </td></tr>';
            $no++;
        }

        if ($pesanan->tipe_pembayaran == 0) {
            $tipe = 'Bank Transfer';
        } else {
            $tipe = 'COD (<i>Cash On Delivery</i>)';
        }
        return response()->json([
            'no_pesanan' => $pesanan->no_pesanan,
            'metode' => $tipe,
            'nama_penerima' => $nama,
            'notelp_penerima' => $notelp,
            'alamat_penerima' => $alamat,
            'total' => 'Rp.' . number_format($pesanan->total, 0, ',', '.'),
            'detail' => $detail
        ]);
    }

    public function pdf(Pesanan $pesanan)
    {
        $pesanan = Pesanan::with(['user', 'pengiriman'])->where('id', $pesanan->id)->first();
        $detail =  Detpesanan::with(['produk'])->where('pesanan_id', $pesanan->id)->get();
        $pdf = Pdf::loadView('pesanan.invoice', [
            'pesanan' => $pesanan,
            'detail' => $detail,
        ]);
        return $pdf->setPaper('a5', 'potrait')->download('invoice_' . strtolower($pesanan->no_pesanan) . '.pdf');
    }
}
