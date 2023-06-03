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
            'title' => 'Home',
            'produk' => Produk::with(['store'])->where('stock_produk', 1)->limit(8)->get(),
            'totalCart' => $this->totalCart(),
        ];
        return view('main.home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
            'totalCart' => $this->totalCart(),
        ];
        return view('main.about', $data);
    }


    public function contact()
    {
        $data = [
            'title' => 'Contact',
            'totalCart' => $this->totalCart(),
        ];
        return view('main.contact', $data);
    }


    public function profile()
    {
        $data = [
            'title' => 'Profile',
            'user' => User::where('id', auth()->user()->id)->first(),
            'totalCart' => $this->totalCart()
        ];

        return view('user.profile', $data);
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

            Store::create([
                'user_id' => $user->id,
                'nama_toko' => $post['nama_toko'],
                'notelp_toko' => $post['notelp_toko'],
                'alamat_toko' => $post['alamat_toko'],
            ]);

            $user->role = 2;
            $user->save();

            return redirect()->route('profile');
        }

        $data = [
            'title' => 'Register Seller',
            'totalCart' => $this->totalCart()
        ];

        return view('auth.regis_seller', $data);
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

            return redirect()->back()->with('success', 'Success Update Password');
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
                $total =  Detpesanan::where('pesanan_id', $pesanan->id)->sum('qty');
            } else {
                $total = 0;
            }
        } else {
            $total = 0;
        }

        return $total;
    }
}
