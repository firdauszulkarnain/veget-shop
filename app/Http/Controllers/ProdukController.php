<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', auth()->user()->id)->first();
        $data = [
            'title' => 'Data produk',
            'produk' => Produk::where('store_id', $store->id)->get(),
        ];

        return view('produk.index', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
        ];

        return view('produk.tambah_produk', $data);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required|numeric',
            'foto_produk' => 'image|file|max:2048',
            'desc_produk' => 'required|min:10',
        ], [
            'nama_produk.required' => 'Nama Produk Tidak Boleh Kosong!',
            'harga_produk.required' => 'Harga Tidak Boleh Kosong!',
            'foto_produk.max' => 'File Gambar Hanya 2 MB!',
            'desc_produk.required' => 'Deskripsi Tidak Boleh Kosong!'
        ]);

        if ($request->file('foto_produk')) {
            $validasi['foto_produk'] = $request->file('foto_produk')->store('gambar-produk');
        }

        $stock = 0;
        if ($request->stock != null) {
            $stock = 1;
        }
        $store = Store::where('user_id', auth()->user()->id)->first();
        Produk::create([
            'nama_produk' => $validasi['nama_produk'],
            'harga_produk' => str_replace(".", "", $validasi['harga_produk']),
            'foto_produk' => $validasi['foto_produk'],
            'stock_produk' => $stock,
            'desc_produk' => $validasi['desc_produk'],
            'store_id' => $store->id,
        ]);

        return redirect('/produk')->with('success', 'Berhasil Tambah Data Produk');
    }


    public function show(Produk $produk)
    {
        //
    }


    public function edit(Produk $produk)
    {
        $data = [
            'title' => 'Update Product',
            'produk' => $produk,
        ];

        return view('produk.update_produk', $data);
    }

    public function update(Request $request, Produk $produk)
    {
        $validasi = $request->validate(
            [
                'nama_produk' => 'required',
                'harga_produk' => 'required|numeric',
                'desc_produk' => 'required|min:10',
            ],
            [
                'nama_produk.required' => 'Nama Product Tidak Boleh Kosong!',
                'harga_produk.required' => 'Harga Tidak Boleh Kosong!',
                'desc_produk.required' => 'Deskripsi Tidak Boleh Kosong!'
            ]
        );

        if ($request->file('foto_produk')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validasi['foto_produk'] = $request->file('foto_produk')->store('gambar-produk');
        }

        $stock = 0;
        if ($request->stock != null) {
            $stock = 1;
        }
        $produk = Produk::find($produk->id);
        $produk->nama_produk = $validasi['nama_produk'];
        $produk->harga_produk = str_replace(".", "", $validasi['harga_produk']);
        $produk->stock_produk = $stock;
        $produk->foto_produk = ($request->file('foto_produk')) ? $validasi['foto_produk'] : $produk->foto_produk;
        $produk->save();
        return redirect('/produk')->with('success', 'Berhasil Update Data Produk');
    }


    public function destroy(Produk $produk)
    {
        Storage::delete($produk->foto_produk);
        Produk::destroy($produk->id);
        return redirect('/produk')->with('success', 'Berhasil Hapus Data Produk');;
    }


    public function update_stock(Produk $produk)
    {
        $oldStock = $produk->stock_produk;
        if ($oldStock == 1) {
            $produk->stock_produk = 0;
        } else {
            $produk->stock_produk = 1;
        }
        $produk->save();

        return redirect()->back()->with('success', 'Berhasil Update Stock Produk');
    }
}
