<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Ongkir;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class OngkirController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', auth()->user()->id)->first();
        $data = [
            'title' => 'Data Ongkir',
            'kabupaten' => Kabupaten::get(),
            'ongkir' => Ongkir::with(['kabupaten', 'kecamatan'])->where('store_id', $store->id)->get(),
        ];

        return view('ongkir.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $store =  Store::where('user_id', auth()->user()->id)->first()->id;
        $check = Ongkir::where(['store_id' => $store, 'kab_id' => $request->kabupaten, 'kec_id' => $request->kecamatan])->first();
        if ($check) {
            return redirect()->back()->with('error', 'Data Ongkir Sudah Ada');
        }

        $ongkir = new Ongkir();
        $ongkir->kab_id = $request->kabupaten;
        $ongkir->kec_id = $request->kecamatan;
        $ongkir->harga_ongkir = str_replace(".", "", $request->harga_ongkir);
        $ongkir->store_id = Store::where('user_id', auth()->user()->id)->first()->id;
        $ongkir->save();

        return redirect('/ongkir')->with('success', 'Berhasil Tambah Data Ongkir');
    }

    public function show(Ongkir $ongkir)
    {
        $ongkir = Ongkir::with(['kabupaten', 'kecamatan'])->where('id', $ongkir->id)->first();

        return response()->json([
            'kabupaten' => $ongkir->kabupaten->nama_kab,
            'kecamatan' => $ongkir->kecamatan->nama_kec,
            'harga_ongkir' => number_format($ongkir->harga_ongkir, 0, ',', '.')
        ]);
    }

    public function edit(Ongkir $ongkir)
    {
        //
    }

    public function update(Request $request, Ongkir $ongkir)
    {
        $ongkir = Ongkir::find($ongkir->id);
        $ongkir->harga_ongkir = str_replace(".", "", $request->harga_ongkir);
        $ongkir->save();

        return redirect('/ongkir')->with('success', 'Berhasil Update Data Ongkir');
    }

    public function destroy(Ongkir $ongkir)
    {
        Ongkir::destroy($ongkir->id);
        return redirect()->back()->with('success', 'Berhasil Hapus Data Ongkir');
    }

    public function get_kecamatan(Request $request)
    {
        $kecamatan = Kecamatan::where('kab_id', $request->id_kab)->get();
        foreach ($kecamatan as $row) {
            echo '<option value="' . $row->id . '">' . $row->nama_kec . '</option>';
        }
    }
}
