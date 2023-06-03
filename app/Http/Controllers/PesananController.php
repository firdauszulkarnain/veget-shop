<?php

namespace App\Http\Controllers;

use App\Models\Detpesanan;
use App\Models\Pengiriman;
use App\Models\Store;
use App\Models\Pesanan;
use Illuminate\Http\Request;

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
}
