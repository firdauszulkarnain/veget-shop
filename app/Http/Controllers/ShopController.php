<?php

namespace App\Http\Controllers;

use App\Models\Ongkir;
use App\Models\Produk;
use App\Models\Invoice;
use App\Models\Pesanan;
use App\Models\Kabupaten;
use App\Models\Detpesanan;
use App\Models\Pengiriman;
use App\Models\Review;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Store $store, Request $request)
    {
        $sort = 'DESC';
        $keyword = null;
        if ($request->isMethod('POST')) {
            $sort = ($request->sort) ? $request->sort : 'DESC';
            if ($request->keyword) {
                $produk = Produk::with(['store'])->select("*", DB::raw('(SELECT SUM(ds.qty) FROM detpesanans ds join pesanans ps on ps.id = ds.pesanan_id WHERE ds.produk_id = produks.id and ps.status > 0) as total'))->where('nama_produk', 'LIKE', '%' . $request->keyword . '%')->where('store_id', $store->id)->orderBy('total', $sort)->paginate(8);
                $keyword = $request->keyword;
            } else {
                $produk = Produk::with(['store'])->select("*", DB::raw('(SELECT SUM(ds.qty) FROM detpesanans ds join pesanans ps on ps.id = ds.pesanan_id WHERE ds.produk_id = produks.id and ps.status > 0) as total'))->where('store_id', $store->id)->orderBy('total', $sort)->paginate(6);
            }
        } else {
            $produk = Produk::with(['store'])->select("*", DB::raw('(SELECT SUM(ds.qty) FROM detpesanans ds join pesanans ps on ps.id = ds.pesanan_id WHERE ds.produk_id = produks.id and ps.status > 0) as total'))->where('store_id', $store->id)->orderBy('total', $sort)->paginate(6);
        }


        $data = [
            'title' => 'Toko',
            'produk' => $produk,
            'sort' => $sort,
            'keyword' => $keyword,
            'store' => $store,
            'totalCart' => $this->totalCart(),
        ];

        return view('main.shop', $data);
    }

    public function shop_list(Request $request)
    {
        $keyword = null;
        if ($request->isMethod('POST')) {
            $store = Store::where('nama_toko', 'LIKE', '%' . $request->keyword . '%')->paginate(6);
            $keyword = $request->keyword;
        } else {
            $store = Store::paginate(6);
        }
        $data = [
            'title' => 'List Toko',
            'keyword' => $keyword,
            'toko' => $store,
            'totalCart' => $this->totalCart(),
        ];

        return view('main.shop_list', $data);
    }

    public function keranjang()
    {
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $id = ($pesanan) ? $pesanan->id : 0;
        $items = Detpesanan::with(['produk'])->where('pesanan_id', $id);

        $data = [
            'title' => 'Keranjang',
            'totalCart' => $this->totalCart(),
            'items' => $items->get(),
            'subtotal' => $items->sum('subtotal')
        ];

        return view('main.keranjang', $data);
    }

    public function tambah_keranjang(Request $request, Produk $produk)
    {
        $user_id = auth()->user()->id;
        $qty = $request->qty;
        $pesanan =  Pesanan::where('user_id', $user_id)->where(['status' => 0])->first();
        $produk = Produk::with(['store'])->find($produk->id);

        if ($pesanan == null) {
            $pesanan = Pesanan::create([
                'user_id' => $user_id,
                'status' => 0,
                'store_id' => $produk->store_id
            ]);
        } else {
            if ($pesanan->store_id != $produk->store_id) {
                Detpesanan::where('pesanan_id', $pesanan->id)->delete();
                $pesanan->store_id = $produk->store_id;
                $pesanan->save();
            }
        }

        $detailPesanan = Detpesanan::where('pesanan_id', $pesanan->id)->where(['produk_id' => $produk->id])->first();
        if ($detailPesanan != NULL) {
            $detailPesanan->qty = $detailPesanan->qty + $qty;
            $detailPesanan->subtotal = $produk->harga_produk * $detailPesanan->qty;
            $detailPesanan->save();
        } else {
            Detpesanan::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $produk->id,
                'store_id' => $produk->store->id,
                'qty' => $qty,
                'subtotal' =>  $produk->harga_produk * $qty,
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil Tambah Produk ke Keranjang');
    }

    public function konfirmasi_pesanan()
    {
        if ($this->totalCart() == 0) {
            return redirect('shop/cart');
        }

        $userId = auth()->user()->id;
        $pesanan =  Pesanan::where('user_id', $userId)->where('status', 0)->first();
        $id = $pesanan->id;
        $items = Detpesanan::with(['produk'])->where('pesanan_id', $id);
        $data = [
            'title' => 'Konfirmasi Pesanan',
            'totalCart' => $this->totalCart(),
            'items' => $items->get(),
            'subtotal' => $items->sum('subtotal'),
            'kabupaten' => Ongkir::with(['kabupaten'])->where('store_id', $pesanan->store_id)->groupBy('kab_id')->get(),
            'store' => $pesanan->store_id,
        ];
        return view('main.konfirmasi_pesanan', $data);
    }

    public function cek_produk(Request $request)
    {
        $change = 0;
        $produk = Produk::where('id', $request->idProduk)->first();
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        if ($pesanan != null) {
            if ($pesanan->store_id != $produk->store_id) {
                $change = 1;
            }
        }

        return response()->json([
            'change' => $change
        ]);
    }

    public function kec_checkout(Request $request)
    {
        $kecamatan = Ongkir::with(['kecamatan'])->where('kab_id', $request->id_kab)->where('store_id', $request->id_store)->get();
        foreach ($kecamatan as $item) {
            echo '<option value="' . $item->kecamatan->id . '">' . $item->kecamatan->nama_kec . '</option>';
        }
    }

    public function detail_ongkir(Request $request)
    {
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $subtotal = Detpesanan::with(['produk'])->where('pesanan_id', $pesanan->id)->sum('subtotal');
        $ongkir = Ongkir::where('kab_id', $request->idkab)->where('kec_id', $request->idkec)->where('store_id', $pesanan->store_id)->first();

        return response()->json([
            'ongkir' => number_format($ongkir->harga_ongkir, 0, ',', '.'),
            'total' => number_format(($subtotal + $ongkir->harga_ongkir), 0, ',', '.')
        ]);
    }

    public function detail_produk(Produk $produk)
    {
        // dd($produk->id);
        $data = [
            'title' => 'Detail Produk',
            'produk' => $produk,
            'related' => Produk::with(['store'])->where('id', '!=', $produk->id)->orderByDesc('created_at')->limit(4)->get(),
            'totalCart' => $this->totalCart(),
            'sold' => Produk::select("*", DB::raw('(SELECT SUM(ds.qty) FROM detpesanans ds join pesanans ps on ps.id = ds.pesanan_id WHERE ds.produk_id = ' . $produk->id . ' and ps.status > 0) as total'))->first()
        ];
        return view('main.detail_produk', $data);
    }

    public function update_qty(Request $request, Detpesanan $detpesanan)
    {
        $qty = $request->qty;
        $produk = Produk::where('id', $detpesanan->produk_id)->first();
        $detpesanan->qty = $qty;
        $detpesanan->subtotal = $qty * $produk->harga_produk;

        $detpesanan->save();
        return redirect()->route('keranjang');
    }


    public function delete_qty(Detpesanan $detpesanan)
    {
        Detpesanan::destroy($detpesanan->id);
        return redirect()->route('keranjang');
    }

    public function proses_pesanan(Request $request)
    {
        $validatedData = $request->validate([
            'tipe_pembayaran' => 'required',
            'nama_penerima' => 'required',
            'notelp_penerima' => 'required|numeric',
            'email' => 'required',
            'alamat_penerima' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'catatan' => 'required'
        ]);

        $invoiceNo = $this->invoiceNo();
        $invoiceNo = 'INV' . date('ymd') . $invoiceNo;

        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $subtotal =  Detpesanan::where('pesanan_id', $pesanan->id)->sum('subtotal');
        $ongkir =  Ongkir::where('kab_id', $validatedData['kabupaten'])->where('kec_id', $validatedData['kecamatan'])->where('store_id', $pesanan->store_id)->first();


        $pesanan->no_pesanan =  $invoiceNo;
        $pesanan->subtotal = $subtotal;
        $pesanan->ongkir = $ongkir->harga_ongkir;
        $pesanan->total = $subtotal + $ongkir->harga_ongkir;
        if ($validatedData['tipe_pembayaran'] == 1) {
            $pesanan->status = 3;
        } else {
            $pesanan->status = 1;
        }
        $pesanan->tgl_pesan = date('Y-m-d');
        $pesanan->tipe_pembayaran = $validatedData['tipe_pembayaran'];
        $pesanan->save();

        Pengiriman::create([
            'pesanan_id' => $pesanan->id,
            'nama_penerima' => $validatedData['nama_penerima'],
            'notelp_penerima' => $validatedData['notelp_penerima'],
            'email' => $validatedData['email'],
            'alamat_penerima' => $validatedData['alamat_penerima'],
            'tgl_pengiriman' => date('Y-m-d'),
            'kab_id' => $validatedData['kabupaten'],
            'kec_id' => $validatedData['kecamatan'],
            'catatan' => $validatedData['catatan'],
        ]);

        if ($validatedData['tipe_pembayaran'] == 1) {
            return redirect()->route('pesanan_saya')->with('success', 'Berhasil Proses Pesanan');
        } else {
            return redirect()->route('pembayaran', $invoiceNo)->with('success', 'Berhasil Proses Pesanan');
        }
    }

    public function pesanan_saya()
    {
        $data = [
            'title' => 'Pesanan Saya',
            'totalCart' => $this->totalCart(),
            'pesanan' => Pesanan::with(['store'])->where('user_id', auth()->user()->id)->where('status', '!=', 0)->get()
        ];

        return view('main.list_pesanan', $data);
    }

    public function pembayaran(Pesanan $pesanan, Request $request)
    {
        if ($request->isMethod('POST')) {
            $post = $request->validate([
                'bukti_bayar' => 'image|file|max:2048',
                'tgl_bayar' => 'required',
            ]);

            if ($request->file('bukti_bayar')) {
                $post['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti_pembayaran');
            }

            $pesanan = Pesanan::find($pesanan->id);
            $pesanan->status = 2;
            $pesanan->bukti_bayar = $post['bukti_bayar'];
            $pesanan->tgl_bayar = date("Y-m-d",  strtotime($post['tgl_bayar']));
            $pesanan->save();

            return redirect()->route('pesanan_saya')->with('success', 'Berhasil Konfirmasi Pembayaran');
        }

        $data = [
            'title' => 'Konfirmasi Pembayaran',
            'totalCart' => $this->totalCart(),
            'pesanan' => Pesanan::where('id', $pesanan->id)->first(),
            'items' => Detpesanan::where('pesanan_id', $pesanan->id)->get()
        ];

        return view('main.konfirmasi_pembayaran', $data);
    }

    public function pesanan_selesai(Pesanan $pesanan, Request $request)
    {
        Review::create([
            'user_id' => $pesanan->user_id,
            'store_id' => $pesanan->store_id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        Invoice::create([
            'pesanan_id' => $pesanan->id,
            'user_id' => $pesanan->user_id,
            'store_id' => $pesanan->store_id,
            'no_invoice' => $pesanan->no_pesanan,
            'total' => $pesanan->total,
            'tgl_invoice' => date('Y-m-d'),
        ]);

        $pesanan->status = 5;
        $pesanan->save();

        return redirect()->route('pesanan_saya')->with('success', 'Berhasil Konfirmasi Pesanan Selesai');
    }

    private function totalCart()
    {
        if (Auth::check()) {
            $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
            if ($pesanan != null) {
                $total =  Detpesanan::where('pesanan_id', $pesanan->id)->groupBy('produk_id')->get();
                $total = $total->count();
            } else {
                $total = 0;
            }
        } else {
            $total = 0;
        }

        return $total;
    }

    private function invoiceNo()
    {
        $no = '';
        $date = date('ymd');
        $pesanan = Pesanan::selectRaw('MAX(MID(no_pesanan,10,5)) AS no_pesanan')->whereRaw("MID(no_pesanan,4,6) = '$date'")->first();

        if ($pesanan->no_pesanan == null) {
            $no = '0001';
        } else {
            $nomor = $pesanan->no_pesanan;
            $nomor = (int)$nomor + 1;
            $no = sprintf("%'.04d", $nomor);
        }

        return $no;
    }

    public function produk_modal(Produk $produk)
    {
        $produk = Produk::with(['store'])->where('id', $produk->id)->first();
        $descProduk = strip_tags(Str::limit($produk->desc_produk, 80));
        $link = '<a href="" class="see-more"> See more </a>';

        return response()->json([
            'nama_produk' => $produk->nama_produk,
            'harga_produk' => 'Rp. ' . number_format($produk->harga_produk, 0, ',', '.'),
            'foto_produk' => asset('storage/' . $produk->foto_produk),
            'desc_produk' => (strlen($descProduk) > 80) ? $descProduk . ' ' . $link : $descProduk,
            'toko' => $produk->store->nama_toko,
        ]);
    }
}
