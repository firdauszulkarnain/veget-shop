<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'totalStore' => Store::count(),
            'totalCustomer' => User::where('role', 3)->count(),
            'totalProduk' => Produk::count(),
            'totalPesanan' => Pesanan::where('status', '!=', 0)->count()
        ];
        return view('admin.dashboard', $data);
    }

    public function produk()
    {
        $data = [
            'title' => 'Data Produk',
            'produk' => Produk::with(['store'])->get()
        ];

        return view('admin.produk', $data);
    }

    public function customer()
    {
        $data = [
            'title' => 'Data Customer',
            'customer' => User::where('role', 3)->orderbyDesc('created_at')->get(),
        ];

        return view('user.customer', $data);
    }

    public function seller()
    {
        $data = [
            'title' => 'Data Seller',
            'seller' => Store::with(['user'])->where('is_active', '<', 2)->orderbyDesc('created_at')->get(),
        ];

        return view('user.seller', $data);
    }

    public function admin()
    {
        $data = [
            'title' => 'Data Administrator',
            'admin' => User::where('role', 1)->where('id', '!=', auth()->user()->id)->where('username', '!=', 'admin')->orderbyDesc('created_at')->get(),
        ];

        return view('user.admin', $data);
    }

    public function tambah_admin(Request $request)
    {

        if ($request->isMethod('POST')) {
            $dataValid = $request->validate([
                'username' => 'required|unique:users,username',
                'notelp' => 'required|numeric|min:10',
                'email' => 'required|unique:users,email|email:rfc,dns',
                'password' => 'required|min:6',
            ], [
                'username.required' => 'Username Tidak Boleh Kosong',
                'notelp.required' => 'No.Telp Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'notelp.numeric' => 'No.Telp Tidak Valid',
                'notelp.min' => 'No.Telp Tidak Valid',
                'password.required' => 'Password Tidak Boleh Kosong',
                'username.unique' => 'Username Sudah Digunakan',
                'email.unique' => 'Email Sudah Digunakan',
                'email.email' => 'Email Tidak Valid',
            ]);


            User::create([
                'username' => $dataValid['username'],
                'notelp' => $dataValid['notelp'],
                'email' => $dataValid['email'],
                'role' => 1,
                'password' => Hash::make($dataValid['password'])
            ]);

            return redirect('/admin/user/admin')->with('success', 'Berhasil Tambah Data Admin');
        }

        $data['title'] = 'Tambah Data Administrator';
        return view('user.tambah_admin', $data);
    }

    public function delete_user(User $user)
    {
        $store = Store::where('user_id', $user->id)->first();
        if ($store) {
            $user = User::find($user->id);
            $user->role = 3;
            $user->save();
            Store::destroy($store->id);
        } else {
            User::destroy($user->id);
        }

        return redirect()->back()->with('success', 'Berhasil Hapus Data User');
    }

    public function profile(Request $request)
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
            'title' => 'Profile Admin',
            'user' => User::where('id', auth()->user()->id)->first()
        ];

        return view('admin.profile', $data);
    }
}
