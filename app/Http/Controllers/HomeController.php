<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Detpesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function home()
    {
        $data = [
            'title' => 'Beranda',
            'produk' => Produk::with(['store'])->where('stock_produk', 1)->limit(8)->get(),
            'totalCart' => $this->totalCart(),
        ];
        return view('main.home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang',
            'totalCart' => $this->totalCart(),
        ];
        return view('main.about', $data);
    }


    public function contact()
    {
        $data = [
            'title' => 'Hubungi Kami',
            'totalCart' => $this->totalCart(),
        ];
        return view('main.contact', $data);
    }


    public function profile(Request $request)
    {
        if ($request->isMethod('POST')) {
            User::where('id', auth()->user()->id)->update([
                'notelp' => $request->notelp,
                'alamat' => $request->alamat
            ]);

            return redirect()->route('profile')->with('success', 'Berhasil Update Profile');
        } else {
            $store = Store::where('user_id', auth()->user()->id)->first();
            $store = ($store) ? $store : null;
            $data = [
                'title' => 'Profil Saya',
                'user' => User::where('id', auth()->user()->id)->first(),
                'totalCart' => $this->totalCart(),
                'store' => $store,
            ];

            return view('user.profile', $data);
        }
    }

    public function register_seller(Request $request)
    {
        if ($request->isMethod('POST')) {
            $user = User::find(auth()->user()->id);
            $post = $request->validate([
                'nama_toko' => 'required',
                'alamat_toko' => 'required',
                'notelp_toko' => 'required',
            ]);

            Store::updateOrCreate(['user_id' => $user->id], [
                'user_id' => $user->id,
                'nama_toko' => $post['nama_toko'],
                'alamat_toko' => $post['alamat_toko'],
                'notelp_toko' => $post['notelp_toko'],
                'is_active' => 0,
            ]);

            return redirect()->route('profile')->with('success', 'Berhasil Daftar Seller');
        }

        $data = [
            'title' => 'Register Seller',
            'totalCart' => $this->totalCart()
        ];

        return view('auth.regis_seller', $data);
    }

    public function approve_seller(Store $store)
    {
        $store = Store::where('id', $store->id)->first();
        $store->is_active = 1;
        $store->save();

        $user = User::where('id', $store->user_id)->first();
        $user->role = 2;
        $user->save();

        return redirect()->back()->with('success', 'Berhasil Konfirmasi Akun Seller');
    }

    public function reject_seller(Store $store)
    {
        $store = Store::where('id', $store->id)->first();
        $store->is_active = 2;
        $store->save();

        return redirect()->back()->with('success', 'Berhasil Tolak Registrasi Seller');
    }


    public function update_password(Request $request)
    {
        if ($request->isMethod('POST')) {
            $post = $request->validate([
                'password' => 'required|min:6',
                'password2' => 'required|same:password',
            ], [
                'password.required' => 'Password Tidak Boleh Kosong',
                'password2.required' => 'Konfirmasi Password Tidak Boleh Kosong',
                'password.min' => 'Password Minimal 6 Karakter',
                'password2.same' => 'Konfirmasi Password Salah',
            ]);

            $post['password'] = Hash::make($post['password']);

            $user = User::find(auth()->user()->id);
            $user->password = $post['password'];
            $user->save();

            return redirect()->back()->with('success', 'Berhasil Update Password');
        }

        $data = [
            'title' => 'My Profile',
            'user' => User::where('id', auth()->user()->id)->first(),
            'totalCart' => $this->totalCart()
        ];

        return view('user.edit_password', $data);
    }

    private function totalCart()
    {
        if (Auth::check()) {
            $pesanan = Pesanan::where(['user_id' => auth()->user()->id, 'status' => 0])->first();
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
}
