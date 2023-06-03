<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Store;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', auth()->user()->id)->first();
        $data = [
            'title' => 'Dashboard',
            'produk' => Produk::where('store_id', $store->id)->count(),
            'masuk' => Pesanan::where('store_id', $store->id)->where('status', '<', 4)->where('status', '>', 1)->count(),
            'kirim' => Pesanan::where('store_id', $store->id)->where('status', 4)->count(),
            'invoice' => Invoice::where('store_id', $store->id)->count(),
            'store' => $store
        ];

        return view('seller.dashboard', $data);
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('POST')) {
            $post = $request->validate([
                'nama_toko' => 'required',
                'alamat_toko' => 'required',
                'notelp_toko' => 'required|numeric',
            ], [
                'nama_toko.required' => 'Store Name Tidak Boleh Kosong',
                'alamat_toko.required' => 'Store Address Tidak Boleh Kosong',
                'notelp_toko.required' => 'Store No. Telp Tidak Boleh Kosong',
                'notelp_toko.numeric' => 'Store No. Telp Hanya Menerima Angka',
            ]);

            $store =  Store::where('user_id', auth()->user()->id)->first();
            $store->nama_toko =  $post['nama_toko'];
            $store->alamat_toko =  $post['alamat_toko'];
            $store->notelp_toko =  $post['notelp_toko'];
            $store->save();
            return redirect()->route('seller.profile')->with('success', 'Berhasil Update Data Store');
        }

        $data = [
            'title' => 'Seller Prfoile',
            'store' => Store::where('user_id', auth()->user()->id)->first()
        ];

        return view('seller.profile', $data);
    }
}
